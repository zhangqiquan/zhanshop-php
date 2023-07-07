<?php
// +----------------------------------------------------------------------
// | flow-admin / sns.php    [ 2021/11/26 9:44 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------

use zhanshop\App;

return [
    // 修改成自己的配置
    'qiniu' => [
        'accesskey' => App::env()->get('SNS_QINIU_ACCESSKEY'),
        'secretkey' => App::env()->get('SNS_QINIU_SECRETKEY'),
        'buckets' => [
            'img' => [
                'bucket' => App::env()->get('SNS_QINIU_BUCKETS_IMAGE'),
                'domain' => App::env()->get('SNS_QINIU_DOMAIN_IMAGE'),
            ],
            'audio' => [
                'bucket' => App::env()->get('SNS_QINIU_BUCKETS_AUDIO'),
                'domain' => App::env()->get('SNS_QINIU_DOMAIN_AUDIO'),
            ],
            'video' => [
                'bucket' => App::env()->get('SNS_QINIU_BUCKETS_VIDEO'),
                'domain' => App::env()->get('SNS_QINIU_DOMAIN_VIDEO'),
            ],
            'file' => [
                'bucket' => App::env()->get('SNS_QINIU_BUCKETS_FILE'),
                'domain' => App::env()->get('SNS_QINIU_DOMAIN_FILE'),
            ],
        ],
    ],
];