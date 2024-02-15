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
use zhanshop\servevent\AdminServEvent;
use zhanshop\console\command\Server;

return [
    'servers' => [
        [
            'name'      => 'admin',
            'mode'      => SWOOLE_BASE,
            'host'      => App::env()->get("DEVICE_HOST", "0.0.0.0"),
            'port'      => (int)App::env()->get("DEVICE_PORT", "6201"),
            'sock_type' => (int)App::env()->get("DEVICE_SOCK", "1"),
            'serv_type' => Server::HTTP,
            'callbacks' => [
                ServEvent::ON_REQUEST => [AdminServEvent::class, 'onRequest'],
                ServEvent::ON_CLOSE => [AdminServEvent::class, 'onClose'],
            ]
        ],
    ],
    'settings' => [
        'worker_num' => App::cpuNum(),
        'reactor_num' => App::cpuNum(),
        'task_worker_num' => 1,
        'enable_static_handler' => true,
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
