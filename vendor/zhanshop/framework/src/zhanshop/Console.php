<?php
// +----------------------------------------------------------------------
// | zhanshop-swoole / Console.php    [ 2021/10/28 2:21 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace zhanshop;

use zhanshop\console\command\Admin;
use zhanshop\console\command\ApiCreate;
use zhanshop\console\command\ApiDoc;
use zhanshop\console\command\Help;
use zhanshop\console\command\Http;
use zhanshop\console\command\Phar;
use zhanshop\console\command\Server;
use zhanshop\console\Input;
use zhanshop\console\Output;
/**
 * 控制台程序不要实例化控制台程序
 * @method static Help help()
 */
class Console{
    /**
     * 请求对象
     * @var null
     */
    protected $input = null;

    /**
     * 输出对象
     * @var null
     */
    protected $output = null;

    /**
     * 注册控制台app
     * @var string[]
     */
    protected $commands = [
        'help'       => Help::class,
        'server' => Server::class,
        'phar' => Phar::class,
        'api:create' => ApiCreate::class,
        'api:manager' => ApiDoc::class
    ];

    /**
     * 容器对象实例
     * @var
     */
    public $instance = [];

    /**
     * 构造器
     * Http constructor.
     */
    public function __construct(){
        $this->init(); // 初始化操作
    }

    /**
     * 执行应用程序
     * @access public
     * @param Request|null $request
     * @return Output
     */
    public function run(array $argv)
    {
        // 注册控制台路由
        $config = App::config()->get('console');
        $this->commands = array_merge($this->commands, $config);

        $this->input = new Input($argv); // 初始化请求类
        $this->output = new Output(); // 输出类
        $this->runWithRequest($this->input);

        return $this->output;
    }

    /**
     * 执行应用逻辑
     * @param Request $request
     * @return Output
     * @throws \Exception
     */
    public function runWithRequest(Input $input){
        $instance = $this->getApp($input->getCommand());
        $instance->configure();
        $instance->initialize(); // 初始化
        if($instance->getIsCoroutine()){
            \Swoole\Coroutine\run(function() use (&$instance, &$input){
                $instance->execute($input, $this->output); // 执行控制台app
            });
        }else{
            $instance->execute($input, $this->output); // 执行控制台app
        }

    }

    /**
     * 获取控制台app
     * @param $command
     * @return mixed
     * @throws \Exception
     */
    public function getApp(mixed $command){
        $this->commands[$command] ?? App::error()->setError($command.'指令未注册', 500);
        if(!isset($this->instance[$command])){
            $this->instance[$command] = new $this->commands[$command]();
        }
        return $this->instance[$command];
    }

    /**
     * 获取所有指令
     * @return string[]
     */
    public function getCommands(){
        return $this->commands;
    }

    /**
     * 执行End
     * @param Response $response
     * @return void
     */
    public function end(Output $output): void
    {

    }
    /**
     * 初始化操作
     */
    protected function init(){
        $inis = App::config()->get('ini');
        foreach ($inis as $k => $v){
            ini_set($k, $v);
        }

        $isPhar = $_SERVER['SCRIPT_IS_PHAR'] ?? false;
        if($isPhar) unset($this->commands['pmake']);
    }
}