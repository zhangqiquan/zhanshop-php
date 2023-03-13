<?php
// +----------------------------------------------------------------------
// | zhanshop-swoole / http.php    [ 2022/5/1 12:18 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2022 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------

use zhanshop\App;
return [
    'servers' => [
        'name'      => 'zhanshop',
        'mode'      => (int)App::env()->get("SOCK_MODE", "2"),
        'host' => App::env()->get("SERV_HOST", "0.0.0.0"),
        'port' => (int)App::env()->get("SERV_PORT", "6200"),
        'sock_type' => (int)App::env()->get("SOCK_TYPE", "1"), // http：1, https:513
        //'cross' => 'TOKEN,Content-Type', // 允许前端跨域header自定义参数
    ],
    'start' => App::env()->get("SERV_TYPE", "http"), // 启动的服务

    'starts' => [
        'http' => [
            //'document_root' => App::rootPath().DIRECTORY_SEPARATOR.'public/',
        ],
        //【注意】 走http协议的话 servers.sock_type = SWOOLE_SOCK_TCP | SWOOLE_SSL , port改成443
        'https' => [
            //'document_root' => App::rootPath().DIRECTORY_SEPARATOR.'public/',
            'ssl_cert_file' => __DIR__.'/ssl/demo123.zhanshop.cn_bundle.crt',
            'ssl_key_file' => __DIR__.'/ssl/demo123.zhanshop.cn.key',
        ]
    ],
    // tasks任务暂时只在主线程中执行
    'task' => [
    ],
    // 定时任务暂时只在主进程执行
    'crontab' => [
        \app\crontab\TcpConnCollect::class,
        \app\task\Test::class
    ],
];