<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / HttpException.php    [ 2023/9/1 17:22 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\exception;

use zhanshop\App;
use zhanshop\Error;
use zhanshop\Request;
use zhanshop\Response;

class HttpException extends Error
{
    /**
     * 错误处理
     * @param Request $request
     * @param Response $response
     * @param \Throwable|null $previous
     * @return void
     */
    public function handle(Request &$request, Response &$response, \Throwable &$previous = null){
        $data = [
            'code' => $previous->getCode(),
            'msg' => $previous->getMessage(),
            'data' => null,
        ];
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
        if($httpCode > 417){
            $rep['response'] = $data;
            $rep['response']['data'] = $previous->getFile().'('.$previous->getLine().'): '.$previous->getMessage().PHP_EOL.$previous->getTraceAsString();
        }
        App::log()->push(json_encode($rep, JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE), "error");

        return $data;
    }
}