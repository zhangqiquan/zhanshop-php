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
    /**
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function handle(Request &$request, Response &$response){
        // 不是这个问题导致的内存泄露
        $code = $response->getStatus();

        $rep = [
            'time' => date('Y-m-d H:i:s'),
            'url' => $request->server('request_uri'),
            'ip' => $request->server('remote_addr'),
            'agent' => $request->header('user-agent'),
            'status' => $code,
            'request' => [
                'get' => $request->get(),
                'post' => $request->post()
            ]
        ];

        if($code >= 417){
            $rep['respon'] = $response->getData();
        }

        App::log()->push(json_encode($rep, JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE), "request");
    }
}