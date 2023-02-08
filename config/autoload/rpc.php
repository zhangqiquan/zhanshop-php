<?php
// +----------------------------------------------------------------------
// | zhanshop-swoole / tcp.php    [ 2022/5/1 12:19 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2022 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);
use zhanshop\App;

return [
    'name' => 'swoole.qiyawang.com',
    'debug' => App::config()->get('app.app_debug', false),
    'listen' => '0.0.0.0:6500',
    'mode'      => SWOOLE_PROCESS,
    'sock_type' => SWOOLE_SOCK_TCP,
    'server_conf' => [
        //'worker_num' => swoole_cpu_num() * 4,
        'reactor_num' => swoole_cpu_num() * 2,
        'pid_file' => App::runtimePath().DIRECTORY_SEPARATOR.'jspn_rpc.pid',
        'log_file'     => App::runtimePath().DIRECTORY_SEPARATOR.'jspn_rpc.log',
        'heartbeat_idle_time' => 30, // 表示一个连接如果30秒内未向服务器发送任何数据，此连接将被强制关闭
        'heartbeat_check_interval' => 30,  // 表示每30秒遍历一次
        'max_connection' => 1000000, // 10万最大连接数
    ],
];