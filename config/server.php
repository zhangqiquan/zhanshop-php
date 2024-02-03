<?php
// +----------------------------------------------------------------------
// | zhanshop-docker-server / http.php    [ 2022/5/1 12:18 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2022 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------

use zhanshop\App;
use zhanshop\ServEvent;
use zhanshop\console\command\Server;
use app\api\admin\WebsocketEvent;
return [
    'servers' => [
        [
            'name'      => 'admin',
            'mode'      => 1,
            'host'      => App::env()->get("DEVICE_HOST", "0.0.0.0"),
            'port'      => (int)App::env()->get("DEVICE_PORT", "6201"),
            'sock_type' => (int)App::env()->get("DEVICE_SOCK", "1"),
            'serv_type' => Server::WEBSOCKET,
            'callbacks' => [
                ServEvent::ON_WORKER_START => [WebsocketEvent::class, 'onWorkerStart'],
                ServEvent::ON_REQUEST => [WebsocketEvent::class, 'onRequest'],
                ServEvent::ON_OPEN => [WebsocketEvent::class, 'onOpen'],
                ServEvent::ON_MESSAGE => [WebsocketEvent::class, 'onMessage'],
                ServEvent::ON_CLOSE => [WebsocketEvent::class, 'onClose'],
            ]
        ],
    ],
    'settings' => [
        'worker_num' => 1,
        'reactor_num' => 1,
        'task_worker_num' => 1,
        'enable_static_handler' => false,
        'document_root' => '',
        'http_autoindex' => true,
        'http_index_files' => ['index.html'],
        'document_root' => App::rootPath().DIRECTORY_SEPARATOR.'public',

        'open_tcp_keepalive' => true,
        'tcp_keepidle' => 60,
        'tcp_keepinterval' => 30,
        'tcp_keepcount' => 2,
    ],
    'crontab' => [
        //\zhanshop\console\crontab\WatchServCronTab::class
    ],
];
