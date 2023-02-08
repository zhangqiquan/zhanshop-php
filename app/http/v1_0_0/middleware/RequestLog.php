<?php
// +----------------------------------------------------------------------
// | zhanshop-php / RequestLog.php [ 2023/1/31 下午10:12 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\http\v1_0_0\middleware;

use zhanshop\App;

class RequestLog
{
    public function handle(&$request, mixed &$resp){
        return [];
        $rep = [
            'url' => $request->server['request_uri'],
            'resp' => $resp,
        ];
        App::log()->push(json_encode($rep, JSON_UNESCAPED_UNICODE), "request");
    }
}