<?php
// +----------------------------------------------------------------------
// | flow-admin / Storagetoken.php    [ 2021/11/26 10:04 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace app\admin\v3_0_0\service\plugin;

use Qiniu\Auth as SdkAuth;
use zhanshop\App;

class Storagetoken
{
    /**
     * 获取七牛对象存储凭证
     * @return array
     */
    public static function qiniu($type){
        $accesskey = App::config()->get('sns.qiniu.accesskey');
        $secretKey = App::config()->get('sns.qiniu.secretkey');
        $buckets = App::config()->get('sns.qiniu.buckets');
        $bucket = $buckets[$type] ?? App::error()->setError($type.'存储空间未配置', 404);
        $auth = new SdkAuth($accesskey, $secretKey);
        return [
            'token' => $auth->uploadToken($bucket['bucket'], null, 600),// 让token的有效期只有10分钟
            'domain' => $bucket['domain'],
        ];
    }


}