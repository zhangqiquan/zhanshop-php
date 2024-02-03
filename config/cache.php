<?php

// +----------------------------------------------------------------------
// | 缓存设置
// +----------------------------------------------------------------------
use zhanshop\App;

return [
    'default'         => App::env()->get('CACHE_DEFAULT', 'default'),
    'connections' => [
        'default' => [
            // REDIS地址
            'host'       => App::env()->get('REDIS_HOST', 'zhanshop-redis'),
            // REDIS端口
            'port'       => App::env()->get('REDIS_PORT', 6379),
            // REDIS密码
            'password'   => App::env()->get('REDIS_PASSWORD', null),
            // REDIS库
            'select'     => App::env()->get('REDIS_SELECT', 0),
            // REDIS 超时时间
            'timeout'    => App::env()->get('REDIS_TIMEOUT', 0),

            'pool' => [
                'max_connections' => 100,
                'timeout' => 0.001,
            ],
        ]
    ]
];
