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
    public function handle(mixed &$request, array &$resp){
        $code = $resp['code'] ?? 0;
        $rep = [
            'time' => date('Y-m-d H:i:s'),
            'url' => $request->server['request_uri'] ?? '',
            'ip' => $request->server['remote_addr'] ?? '',
            'agent' => $request->header['user-agent'] ?? '',
            'trace' => $resp['trace_id'],
            'code' => $code,
            'msg'  => $resp['msg'],
            'data' => ($code != 0) ? $resp['data'] : null
        ];
        App::log()->push(json_encode($rep, JSON_UNESCAPED_UNICODE), "request");
    }
}