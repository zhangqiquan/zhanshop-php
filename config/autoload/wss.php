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
        'host' => '0.0.0.0',
        'port' => 9503,
        'sock_type' => (int)App::env()->get("SOCK_TYPE", "1"),
    ],
    'start' => 'ws', // 启动的服务
    'starts' => [
        'ws' => [
        ],
        //【注意】 走http协议的话 servers.sock_type = SWOOLE_SOCK_TCP | SWOOLE_SSL , port改成443
        'wss' => [
            //启用 HTTP2 协议解析【默认值：false】
            'open_http2_protocol' => true,
            'ssl_cert_file' => __DIR__.'/ssl/demo123.zhanshop.cn_bundle.crt',
            'ssl_key_file' => __DIR__.'/ssl/demo123.zhanshop.cn.key',
        ]
    ],
    // tasks任务暂时只在主线程中执行
    'task' => [
    ],
    // 定时任务暂时只在主进程执行
    'crontab' => [
        \app\task\Test::class
    ],
];