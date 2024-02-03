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

class WebSocketException extends Error
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
            'code' => $previous->getCode() < 200 ? 500 : $previous->getCode(),
            'msg' => $previous->getMessage(),
            'data' => [
                'file' => $previous->getFile(),
                'line' => $previous->getLine(),
                'trace' => $previous->getTrace()
            ],
        ];
        $rep = [
            'time' => date('Y-m-d H:i:s'),
            'uri' => $request->server('request_uri'),
            'header' => $request->header(),
            'param' => $request->post(),
            'response' => $data
        ];
        App::log()->push(json_encode($rep, JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE), "REQ-ERROR");
        $data['data'] = null;
        $fd = $request->getData('fd', 0);
        if($fd && is_numeric($fd)) $response->setFd((int)$fd);
        return [
            'uri' => '/v1/device.error',
            'header' => [],
            'body' => $data
        ];
    }
}