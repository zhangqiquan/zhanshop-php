<?php

use zhanshop\App;

return [
    'connection' => [
        'host' => explode(',', App::env()->get('ES_HOST', 'zhanshop-elasticsearch')),
        'port' => App::env()->get('ES_PORT', '9200'),
        'scheme' => App::env()->get('ES_SCHEME', 'http'),
        'key' => App::env()->get('ES_KEY', ''),
        'user' => App::env()->get('ES_USER', ''),
        'pass' => App::env()->get('ES_PASS', ''),
        'crt' => App::env()->get('ES_CRT', ''),
        'cloud' => App::env()->get('ES_CLOUDID', ''),
    ]
];