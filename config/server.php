<?php
// +----------------------------------------------------------------------
// | zhanshop-swoole / http.php    [ 2022/5/1 12:18 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2022 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------

use zhanshop\App;
use zhanshop\ServEvent;
use zhanshop\console\command\Server;
use zhanshop\servevent\AdminServEvent;
use zhanshop\servevent\GrpcServEvent;
use zhanshop\servevent\JsonRpcEvent;

/**
 *  mode(1:SWOOLE_BASE 2: SWOOLE_PROCESS), sock(1:SWOOLE_SOCK_TCP, 2:SWOOLE_SOCK_UDP, 513:SWOOLE_SOCK_TCP | SWOOLE_SSL)
 */
return [
    'servers' => [
        [
            'name'      => 'index',
            'mode'      => (int)App::env()->get("SERVER_INDEX_MODE", "1"),
            'host'      => App::env()->get("SERVER_INDEX_HOST", "0.0.0.0"),
            'port'      => (int)App::env()->get("SERVER_INDEX_PORT", "6201"),
            'sock_type' => (int)App::env()->get("SERVER_INDEX_SOCK", "1"),
            'serv_type' => Server::HTTP,
            'callbacks' => [
                ServEvent::ON_REQUEST => [ServEvent::class, 'onRequest'],
            ]
        ],
        [
            'name'      => 'admin',
            'mode'      => (int)App::env()->get("SERVER_ADMIN_MODE", "1"),
            'host'      => App::env()->get("SERVER_ADMIN_HOST", "0.0.0.0"),
            'port'      => (int)App::env()->get("SERVER_ADMIN_PORT", "6202"),
            'sock_type' => (int)App::env()->get("SERVER_ADMIN_SOCK", "1"),
            'serv_type' => Server::WEBSOCKET,
            'callbacks' => [
                ServEvent::ON_REQUEST => [AdminServEvent::class, 'onRequest'],
                ServEvent::ON_OPEN => [AdminServEvent::class, 'onOpen'],
                ServEvent::ON_MESSAGE => [AdminServEvent::class, 'onMessage'],
                ServEvent::ON_CLOSE => [AdminServEvent::class, 'onClose'],
            ]
        ],
        [
            'name'      => 'grpc',
            'mode'      => (int)App::env()->get("SERVER_GRPC_MODE", "1"),
            'host'      => App::env()->get("SERVER_GRPC_HOST", "0.0.0.0"),
            'port'      => (int)App::env()->get("SERVER_GRPC_PORT", "6203"),
            'sock_type' => (int)App::env()->get("SERVER_GRPC_SOCK", "1"),
            'serv_type' => Server::HTTP,
            'cross' => 'TOKEN,Content-Type', // 允许前端跨域header自定义参数
            'callbacks' => [
                ServEvent::ON_REQUEST => [GrpcServEvent::class, 'onRequest'],
            ],
            'settings' => [
                'open_http2_protocol' => true,
            ],
        ],
        [
            'name'      => 'jsonRpc',
            'mode'      => (int)App::env()->get("SERVER_TCP_MODE", "1"),
            'host'      => App::env()->get("SERVER_TCP_HOST", "0.0.0.0"),
            'port'      => (int)App::env()->get("SERVER_TCP_PORT", "6204"),
            'sock_type' => (int)App::env()->get("SERVER_TCP_SOCK", "1"),
            'serv_type' => Server::TCP,
            'cross' => 'TOKEN,Content-Type', // 允许前端跨域header自定义参数
            'callbacks' => [
                ServEvent::ON_RECEIVE => [JsonRpcEvent::class, 'onReceive'],
            ],
            'settings' => [
                'open_eof_split' => true,
                'package_eof' => "\r\n",
                'package_max_length' => 1024 * 1024 * 2,
            ],
        ],
        [
            'name'      => 'udp',
            'mode'      => (int)App::env()->get("SERVER_UDP_MODE", "1"),
            'host'      => App::env()->get("SERVER_UDP_HOST", "0.0.0.0"),
            'port'      => (int)App::env()->get("SERVER_UDP_PORT", "6205"),
            'sock_type' => 2,
            'serv_type' => Server::UDP,
            'cross' => 'TOKEN,Content-Type', // 允许前端跨域header自定义参数
            'callbacks' => [],
        ]
    ],
    'settings' => [
        'enable_static_handler' => true, // 静态服务配置仅在主服务生效,子服务上设置这个参数不生效
        'document_root' => '',
        'http_autoindex' => true,
        'http_index_files' => ['index.html'],
        'document_root' => App::rootPath().DIRECTORY_SEPARATOR.'public',
        //'max_request' => 1000
        /**
        //【不推荐】启用https的话打开下面配置并且servers下的sock_type=513，【推荐】cdn负载指向本http服务，cdn暴露给用户的地址走https这样能充分发挥性能】
        'open_http2_protocol' => true,
        'ssl_cert_file' => App::rootPath().'/config/sslcert/test.crt',
        'ssl_key_file' => App::rootPath().'/config/sslcert/test.key',
         */
    ],
    // tasks任务暂时只在主线程中执行
    'task' => [
    ],
    // 定时任务
    'crontab' => [
        //\app\crontab\DayStatistics::class
    ],
];