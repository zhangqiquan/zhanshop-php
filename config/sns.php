<?php
// +----------------------------------------------------------------------
// | flow-admin / sns.php    [ 2021/11/26 9:44 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);
return [
    // 修改成自己的配置
    'qiniu' => [
        'accesskey' => '七牛的accesskey',
        'secretkey' => '七牛的secretkey',
        'buckets' => [
            'img' => [
                'bucket' => 'test-zhanshop',
                'domain' => 'http://test-cdn.zhanshop.cn',
            ],
            'audio' => [
                'bucket' => 'test-zhanshop',
                'domain' => 'http://test-cdn.zhanshop.cn',
            ],
            'video' => [
                'bucket' => 'test-zhanshop',
                'domain' => 'http://test-cdn.zhanshop.cn',
            ],
            'file' => [
                'bucket' => 'test-zhanshop',
                'domain' => 'http://test-cdn.zhanshop.cn',
            ],
        ],
    ],
    'robot' => [
//        'type' => 'QyWeChat', // 支持钉钉DingDing 企业微信QyWeChat 飞书Feishu
//        'url' => 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=xxx',
    ],
];