<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / HttpServer.php    [ 2023/4/12 15:43 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace zhanshop\console\command;

use zhanshop\App;
use zhanshop\console\Command;
use zhanshop\console\command\software\ScanPorts;
use zhanshop\console\crontab\WatchLogCronTab;
use zhanshop\console\Input;
use zhanshop\console\Output;
use zhanshop\console\process\TaskScheduler;
use zhanshop\console\ServerStatus;
use zhanshop\console\TaskManager;
use zhanshop\Log;
use zhanshop\ServEvent;
use zhanshop\console\crontab\WatchServCronTab;
use zhanshop\ShareData;
use zhanshop\Timer;
use zhanshop\WebHandle;

class Server extends Command
{
    public const TCP       = 1;
    public const UDP       = 2;
    public const HTTP      = 3;
    public const WEBSOCKET = 4;

    protected $config = [
        'servers' => [
            [
                'name'      => 'zhanshop',
                'mode'      => SWOOLE_BASE,
                'host'      => '0.0.0.0',
                'port'      => 9501,
                'sock_type' => SWOOLE_SOCK_TCP,
                'serv_type' => Server::HTTP,
                'cross' => 'TOKEN',
                'settings' => [],
                'callbacks' => [
                ],
            ]
        ],
        // 关于静态化访问 正式环境中不提供该功能
        'settings' => [
            'daemonize' => true,
            'enable_coroutine' => true, // 这个只是将OnRequest 方法变成非阻塞而已而没有把mysql的操作变成非阻塞
            'hook_flags' => SWOOLE_HOOK_ALL,
            'log_level' => SWOOLE_LOG_NOTICE, // 仅记录错误日志以上的日志
            'log_rotation' => SWOOLE_LOG_ROTATION_DAILY, // 每日日志
            'task_worker_num' => 1,
            'task_enable_coroutine' => true,
            'max_request' => 0,
            'max_wait_time' => 2,
            'enable_static_handler' => false,
            'document_root' => '',
            'http_autoindex' => true,
            'http_index_files' => ['index.html'],
            'max_connection' => 200000,
            //'ssl_cert_file' => '/ssl/swagger.crt',
            //'ssl_key_file' => '/ssl/swagger.key',
        ],
        // 定时任务是在子进程启动之后就开始执行【定时任务不受reload影响，需要restart后生效】
        'crontab' => [
        ],
        // 自定义进程
        'process' => [

        ]
    ];

    protected $callbacks = [
        ServEvent::ON_START => [ServEvent::class, 'onStart'],
        ServEvent::ON_WORKER_START => [ServEvent::class, 'onWorkerStart'],
        ServEvent::ON_WORKER_STOP => [ServEvent::class, 'onWorkerStop'],
        ServEvent::ON_WORKER_EXIT => [ServEvent::class, 'onWorkerExit'],
        ServEvent::ON_WORKER_ERROR => [ServEvent::class, 'onWorkerError'],
        ServEvent::ON_PIPE_MESSAGE => [ServEvent::class, 'onPipeMessage'],
        ServEvent::ON_REQUEST => [ServEvent::class, 'onRequest'],
        ServEvent::ON_RECEIVE => [ServEvent::class, 'onReceive'],
        ServEvent::ON_CONNECT => [ServEvent::class, 'onConnect'],
        //ServEvent::ON_HAND_SHAKE => [ServEvent::class, 'onHandshake'],
        ServEvent::ON_OPEN => [ServEvent::class, 'onOpen'],
        ServEvent::ON_MESSAGE => [ServEvent::class, 'onMessage'],
        ServEvent::ON_CLOSE => [ServEvent::class, 'onClose'],
        ServEvent::ON_TASK => [ServEvent::class, 'onTask'],
        ServEvent::ON_FINISH => [ServEvent::class, 'onFinish'],
        ServEvent::ON_SHUTDOWN => [ServEvent::class, 'onShutdown'],
        ServEvent::ON_PACKET => [ServEvent::class, 'onPacket'],
        ServEvent::ON_MANAGER_START => [ServEvent::class, 'onManagerStart'],
        ServEvent::ON_MANAGER_STOP => [ServEvent::class, 'onManagerStop'],
        // 由于swoole5开始默认走SWOOLE_BASE模式就不存在管理进程下面两个方法主在SWOOLE_PROCESS下有效
        //ServEvent::ON_BEFORE_RELOAD => [ServEvent::class, 'onBeforeReload'],
        //ServEvent::ON_BEFORE_SHUTDOWN => [ServEvent::class, 'onBeforeShutdown'],
    ];

    public function configure(){
        $this->setTitle('启动HTTP服务器')->setDescription('使用该命令可以创建一个http服务器');
    }

    protected $command;
    protected static $servNames = [];

    /**
     * runtime运行文件初始化
     * @return void
     */
    protected function runtimeInit(){
        if(!file_exists(App::runtimePath())){
            mkdir(App::runtimePath());
        }

        if(!file_exists(App::runtimePath().DIRECTORY_SEPARATOR.'log')){
            mkdir(App::runtimePath().DIRECTORY_SEPARATOR.'log');
        }

        if(!file_exists(App::runtimePath().DIRECTORY_SEPARATOR.'server')){
            mkdir(App::runtimePath().DIRECTORY_SEPARATOR.'server');
        }
    }

    /**
     * 初始化
     * @param array $argv
     * @return void
     * @throws \Exception
     */
    protected function init(array &$argv){
        $this->usage($argv);
        $this->command = $argv[0];
        if(($argv[1] ?? 'true') == 'false') $this->config['settings']['daemonize'] = false;

        $config = App::config()->get('server');
        $servers = $config['servers'] ?? $this->config['servers'];
        unset($config['servers']);
        foreach($config as $k => $v){
            if(isset($this->config[$k]) && is_array($this->config[$k])){
                $this->config[$k] = array_merge($this->config[$k], $v);
            }
        }
        $this->config['servers'] = $servers;
        self::$servNames = array_column($servers, 'name');

        $callbacks = $this->config['servers'][0]['callbacks'] ?? [];
        foreach($this->callbacks as $k => $v){
            if(isset($callbacks[$k]) == false){
                $callbacks[$k] = $v;
            }
        }
        $this->config['servers'][0]['callbacks'] = $callbacks;
        $this->config['settings']['pid_file'] = App::runtimePath().DIRECTORY_SEPARATOR.'server'.'.pid';
        $logDir = App::runtimePath().DIRECTORY_SEPARATOR.'server';
        // 检查日志目录是否存在
        if(!file_exists($logDir)) mkdir($logDir);
        $this->config['settings']['log_file'] = $logDir.DIRECTORY_SEPARATOR.'server.log';
        $this->config['settings']['worker_num'] = $this->config['settings']['worker_num'] ?? swoole_cpu_num();
        $this->config['settings']['reactor_num'] = $this->config['settings']['reactor_num'] ?? swoole_cpu_num();
        // 由于swoole暂不支持多个http静态文件访问(当server个数大于1禁用enable_static_handler)
        // 由于swoole http静态文件访问 HTTP2有bug 当开启open_http2_protocol(禁用enable_static_handler)
        $http2 = $this->config['settings']['open_http2_protocol'] ?? false;
        if($http2){
            //$this->config['settings']['enable_static_handler'] = false;
        }

        //$this->config['settings']['stats_file'] = App::runtimePath().DIRECTORY_SEPARATOR.'status'.DIRECTORY_SEPARATOR.$this->loadName.'.json';
    }

    protected Input $input;
    protected Output $output;

    /**
     * 入口
     * @param Input $input
     * @param Output $output
     * @return mixed|void
     * @throws \Exception
     */
    public function execute(Input $input, Output $output){
        $this->runtimeInit();
        $this->input = $input;
        $this->output = $output;
        // 第一个参数 server 第二个参数启动 关闭 重载 重启 第三个参数 是否后台启动
        $argv = $input->getArgv();
        $this->init($argv);
        $command = $this->command;
        $this->$command();
    }

    /**
     * 检查服务是否运行
     * @return false|int
     */
    protected function isRuning(){
        try {
            $pidFile = $this->config['settings']['pid_file'];
            if(file_exists($pidFile)){
                $pid = intval(file_get_contents($this->config['settings']['pid_file']));
                if($pid && \Swoole\Process::kill($pid, 0)){
                    return $pid;
                }
            }
        }catch (\Throwable $e){
        }
        return false;
    }

    /**
     * 检查服务端口是否被占用
     * @return bool
     */
    protected function isUsePort(){
        foreach($this->config['servers'] as $server){
            $host = $server['host'];
            $port = $server['port'];
            $servType = $server['serv_type'];
            if($servType == 2){
                if(ScanPorts::checkUdp($host, $port) == 1){
                    return true; // 被占用
                }
            }else{
                if(ScanPorts::checkTcp($host, $port) == 1){
                    return true; // 被占用
                }
            }
        }
        return false;
    }

    /**
     * 服务事件绑定
     * @param \Swoole\Server $server
     * @param $callbacks
     * @return void
     */
    protected function serverEventBind(mixed &$server, array &$callbacks){
        foreach($callbacks as $k => $v){
            $server->on($k, [App::make($v[0], [$server, self::$servNames]), $v[1]]);
        }
    }

    /**
     * 创建Server对象
     * @param $servType
     * @param $host
     * @param $port
     * @param $mode
     * @param $sockType
     * @return \Swoole\Http\Server|\Swoole\Server|\Swoole\WebSocket\Server
     */
    protected function createServer(array &$conf){
        $conf['settings'] = $conf['settings'] ?? [];
        $servType = $conf['serv_type'];
        $host = $conf['host'];
        $port = $conf['port'];
        $mode = $conf['mode'] ?? SWOOLE_BASE;
        $sockType = $conf['sock_type'];
        switch ($servType){
            case Server::HTTP:
                $conf['settings']['open_http_protocol'] = true;
                $server = new \Swoole\Http\Server($host, $port, $mode, $sockType);
                break;
            case Server::WEBSOCKET:
                $conf['settings']['open_websocket_protocol'] = true;
                $server = new \Swoole\WebSocket\Server($host, $port, $mode, $sockType);
                break;
            default:
                $server = new \Swoole\Server($host, $port, $mode, $sockType);
        }
        return $server;
    }

    /**
     * 添加监听服务
     * @param mixed $server
     * @param array $conf
     * @return mixed
     */
    public function addListenServer(\Swoole\Server &$server, array &$conf){
        $conf['settings'] = $conf['settings'] ?? [];
        $servType = $conf['serv_type'];
        $host = $conf['host'];
        $port = $conf['port'];
        $sockType = $conf['sock_type'];

//        $conf['settings']['open_http_protocol'] = false;
//        $conf['settings']['open_websocket_protocol'] = false;
//        $conf['settings']['open_mqtt_protocol'] = false;
//        $conf['settings']['open_redis_protocol'] = false;

        switch ($servType){
            case Server::HTTP:
                $conf['settings']['open_http_protocol'] = true;
                break;
            case Server::WEBSOCKET:
                $conf['settings']['open_http_protocol'] = true;
                $conf['settings']['open_websocket_protocol'] = true;
                break;
        }
        $subServer = $server->listen($host, $port, $sockType);
        return $subServer;
    }

    /**
     * 监听协议
     * @param array $conf
     * @param bool $echoListenMsg
     * @return string
     */
    protected function listenProtocol(array $conf, bool $echoListenMsg = true){
        $protocol = 'tcp';
        switch ($conf['serv_type']){
            case Server::UDP:
                $protocol = 'udp';
                break;
            case Server::HTTP:
                $protocol = 'http';
                break;
            case Server::WEBSOCKET:
                $protocol = 'ws';
                break;
        }

        if($conf['sock_type'] >= 512) $protocol .= 's';
        if($this->config['settings']['daemonize'] == false && $echoListenMsg) echo '['.date('Y-m-d H:i:s').'] ###[listen]###'." ".$protocol.'://'.$conf['host'].':'.$conf['port'].'/'.PHP_EOL;
        return $protocol;
    }

    /**
     * 启动服务器
     * @return void|null
     */
    public function start(){

        // 并且检查端口是否被占用
        if($this->isRuning() && $this->isUsePort()){
            return $this->output->output("程序已在运行...", 'info');
        }
        $server = null;
        foreach($this->config['servers'] as $k => $v){
            if($k == 0){
                //if(!in_array($v['serv_type'], [Server::HTTP, Server::WEBSOCKET])) App::error()->setError('主server的serv_type必须为HTTP | ');
                $server = $this->createServer($v);
                $settings = array_merge($this->config['settings'], $v['settings']);
                if($v['serv_type'] != Server::HTTP){
                    $settings['enable_static_handler'] = false; // 如果主服务不是http关闭http静态访问配置不然其他类型服务存在异常
                }
                $server->set($settings);
                $this->serverEventBind($server, $v['callbacks']);
            }else if($server){
                if($v['serv_type'] > $this->config['servers'][0]['serv_type']) App::error()->setError("第".($k+1).'个server的serv_type值不得高于首个serv_type的值');
                $subServer = $this->addListenServer($server, $v);
                $subServer->set($v['settings']);
                $callbacks = $v['callbacks'] ?? [];
                if($callbacks) $this->serverEventBind($subServer, $callbacks);
            }
            $this->listenProtocol($v);
        }

        $customMsg = "";

        // 用户进程的生存周期与 Master 和 Manager 是相同的，不会受到 reload 影响 修改定时任务啥的需要重启
        if($this->config['crontab']){
            // 当存在定时任务的时候才会启动定时任务进程
            $process = new \Swoole\Process(function ($process) use ($server) {
                $process->set(['enable_coroutine' => true, 'hook_flags' => SWOOLE_HOOK_ALL]);
                App::make(TaskManager::class, [$server]);
                foreach($this->config['crontab'] as $v){
                    App::make(Timer::class)->register(new $v($server)); // 根据配置执行定时任务
                }
                //echo PHP_EOL.'['.date('Y-m-d H:i:s').']' .' ###[info]### 定时任务启动, 进程'.getmypid().PHP_EOL.PHP_EOL;
            }, false, 2, true);
            $server->addProcess($process);
            $customMsg .= "定时进程开启 ";
        }

        // 用户自定义进程
        if($this->config['process']){
            foreach($this->config['process'] as $v){
                $process = new \Swoole\Process(function ($process) use ($server, $v) {
                    $process->set(['enable_coroutine' => true]);
                    App::make($v)->execute($server);
                }, false, 2, true);
                $server->addProcess($process);
            }
            $customMsg .= "自定义进程数".count($this->config['process']).' ';

        }

        if($customMsg) Log::errorLog(SWOOLE_LOG_NOTICE, $customMsg);

        ShareData::make(); // 构建共享内存实例

        $server->start();
    }

    /**
     * 重启服务器
     * @return void
     */
    public function restart(){
        $this->stop();
        $this->start();
    }

    /**
     * 停止服务器
     * @return void
     */
    public function stop(){
        $pid = $this->isRuning();
        if($pid){
            try {
                \Swoole\Process::kill($pid, SIGTERM);
                $startTime = microtime(true);
                while ($this->isRuning()){
                    usleep(100);
                    if((microtime(true) - $startTime) > 10){
                        $this->output->output('终止程序失败', 'error');
                        exit();
                    }
                }
                if(file_exists($this->config['settings']['pid_file'])) @unlink($this->config['settings']['pid_file']);
            }catch (\Throwable $e){
                $this->output->output($e->getMessage(), 'error');
                exit();
            }
        }
    }

    /**
     * 重载热更新工作进程
     * @return void
     */
    public function reload(){
        $pid = $this->isRuning();
        if($pid){
            try {
                \Swoole\Process::kill($pid, SIGUSR1);
                $this->output->output("重载完成", 'success');
            }catch (\Throwable $e){
                $this->output->output($e->getMessage(), 'error');
                exit();
            }
        }else{
            $this->output->output("程序尚未启动", 'info');
        }
    }

    /**
     * 输出服务器状态信息
     * @return void
     */
    public function status(){
        $pid = $this->isRuning();
        if($pid){
            echo PHP_EOL."--------------------------SERVER STATUS------------------------------------------------------".PHP_EOL;
            echo PHP_EOL.'swoole版本: '.swoole_version().'   php版本: '.PHP_VERSION.', 环境：'.($_SERVER['APP_ENV'] ?? 'dev').PHP_EOL.PHP_EOL;
            \Swoole\Coroutine\run(function() use ($pid){
                $protocol = $this->listenProtocol($this->config['servers'][0], false);
                $statusInfo = ServerStatus::info($protocol.'://'.$this->config['servers'][0]['host'].':'.$this->config['servers'][0]['port']);
                if($statusInfo){
                    $statusNum = 0;
                    foreach ($statusInfo as $k => $v){
                        echo $k.'：';
                        App::make(Output::class)->echo((string)$v, 'left', 16);
                        if($statusNum % 4 == 0) echo PHP_EOL;
                        $statusNum++;
                    }
                }else{
                    $pRunTimes = \Swoole\Coroutine\System::exec('ps -p '.$pid.' -o etimes,etime');
                    $pRunTimes = explode('       ', $pRunTimes['output']);
                    $pRunTime = array_values(array_filter(explode('   ', explode("\n", $pRunTimes[0])[1])))[0];
                    $pRunTime = intval($pRunTime);
                    echo '['.date('Y-m-d H:i:s', time() - $pRunTime).'] 开始运行, 现已运行: '.ServerStatus::getTimeStr($pRunTime).PHP_EOL.PHP_EOL;
                }

            });

            usleep(100);
            echo PHP_EOL."--------------------------SERVER STATUS------------------------------------------------------".PHP_EOL.PHP_EOL;

            exit();
        }
        //$this->output->output("程序尚未启动", 'info');
    }

    public function poweron(){
        if($_SERVER['USER'] != 'root'){
            App::error()->setError('请使用root用户执行该命令');
        }

        $pwd = App::rootPath();
        // 检查文件是否存在
        $serviceName = basename($pwd).'-zhanshop-'.substr(md5(dirname($pwd)), -4, 4);
        $serviceFile = '/etc/systemd/system/'.$serviceName.'.service';
        if(file_exists($serviceFile)){
            \Swoole\Coroutine\run(function() use ($serviceName, $serviceFile){
                \Swoole\Coroutine\System::exec('systemctl disable '.$serviceName);
                unlink($serviceFile);
            });
        }

        $phpCommand = 'php';
        if(isset($_SERVER['_'])){
            $phpCommand = $_SERVER['_'];
        }else if(isset($_SERVER['SUDO_COMMAND'])){
            $phpCommand = explode(' ', $_SERVER['SUDO_COMMAND'])[0];
        }

        $serviceCode = '[Unit]
Description='.$pwd.' - project
[Service]
Type=forking
ExecStart='.$phpCommand.' '.$pwd.'/'.$_SERVER['PHP_SELF'].' server start
ExecReload='.$phpCommand.' '.$pwd.'/'.$_SERVER['PHP_SELF'].' server reload
ExecStop='.$phpCommand.' '.$pwd.'/'.$_SERVER['PHP_SELF'].' server stop
Execenable='.$phpCommand.' '.$pwd.'/'.$_SERVER['PHP_SELF'].' server start
[Install]
WantedBy=multi-user.target
';

        \Swoole\Coroutine\run(function() use ($serviceFile, $serviceName, $serviceCode){

            file_put_contents($serviceFile, $serviceCode);
            \Swoole\Coroutine\System::exec('systemctl enable '.$serviceName);

        });
        $this->start();
    }


    // 支持到多端口

    public function usage(&$argv){
        if(!$argv){
            $this->output->output("\n示例用法:\n", 'success');
            echo 'php cmd.php server {start | stop | reload | restart | status |  poweron } {true|false}'.'   // 启动Server服务'.PHP_EOL;
            $this->output->output("\n参数说明：server 后的一个参数{启动|关闭|重载|重启|状态|开机启动} {后台启动(不指定默认)|非后台启动}");
            $this->output->output("关于环境：请修改全局环境变量 APP_ENV=dev或者APP_ENV=production 没有指定将会载入dev环境文件");
            exit();
        }
    }

}