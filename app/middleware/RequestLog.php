<?php
// +----------------------------------------------------------------------
// | zhanshop_admin / RequestLog.php [ 2023/4/29 下午10:46 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\middleware;

use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

class RequestLog
{
    public function handle(Request &$request, \Closure &$next){
        $response = $next($request);
        $httpCode = $response->getHttpCode();
        $rep = [
            'time' => date('Y-m-d H:i:s'),
            'url' => $request->server('request_uri'),
            'ip' => $request->server('remote_addr'),
            'agent' => $request->header('user-agent'),
            'code' => $httpCode,
            'msg' => $response->getMsg(),
            'request' => [
                'get' => $request->get(),
                'post' => $request->post(),
                'file' => $request->files()
            ]
        ];
        // 只完整记录417以上的错误错误
        if($httpCode > 417){
            $rep['response'] = $response->getData();
        }
        App::log()->push(json_encode($rep, JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE), "request");
        return $response;
    }
}