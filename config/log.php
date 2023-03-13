<?php

// +----------------------------------------------------------------------
// | 日志设置
// +----------------------------------------------------------------------
return [
    // 日志记录方式
    'type'           => 'File',
    'connections' => [
        'File' => [

        ],
        'Db' => [
            'max_request' => 2000,
            'table' => 'system_logs', // 这个表需要包含3个字段 id bigint 递增、timestamp varchar(20) 、 body text
        ],
        'Es' => [
            // 日志收集的地址
            'host' => 'http://192.168.1.12:9200',
            // apiKey
            'apikey' => "QllFNzFvWUIwSUVHLVEwdlVYam06N2hMRTc0LVhSbGVXSG1jeV82aTdhdw==",
            // 写入到的索引
            'index' => 'zhanshop-'.date('Y').'.'.date('m'),
            // 单次批量写入最大条数
            'max_request' => 2000,
        ],
    ],
];
