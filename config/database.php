<?php

use zhanshop\App;
use app\helper\YouYao;

return [
    // 默认使用的数据库连接配置
    'default' => App::env()->get('DB_DEFAULT', 'mysql'),

    // 自定义时间查询规则
    'time_query_rule' => [],

    // 自动写入时间戳字段
    // true为自动识别类型 false关闭
    // 字符串则明确指定时间字段类型 支持 int timestamp datetime date
    'auto_timestamp' => 'int',

    // 时间字段取出后的默认时间格式
    'datetime_format' => false,

    // 时间字段配置 配置格式：create_time,update_time
    'datetime_field' => '',

    // 数据库连接配置信息
    'connections' => [
        'mysql' => [
            // 数据库类型
            'type' => 'mysql',
            // 服务器地址
            'hostname' => App::env()->get('DB_HOST', 'zhanshop-mysql'),
            // 数据库名
            'database' => App::env()->get('DB_DATABASE', 'zhanshop-device'),
            // 用户名
            'username' => App::env()->get('DB_USERNAME', 'root'),
            // 密码
            'password' => App::env()->get('DB_PASSWORD', '123456'),
            // 端口
            'hostport' => App::env()->get('DB_PORT', '3306'),
            // 数据库连接参数
            'params' => [
                PDO::ATTR_TIMEOUT => 5,
            ],
            // 数据库编码
            'charset' => App::env()->get('DB_CHARSET', 'utf8mb4'),
            //指定查询对象.
            'query' => 'query',
            'pool' => [
                'max_connections' => 100,
                'timeout' => 0.001,
            ],
        ],
    ],
];
