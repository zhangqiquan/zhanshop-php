<?php
// +----------------------------------------------------------------------
// | User控制器【系统生成】   [ 2023-02-04 19:46:14 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace app\http\v1_0_0\controller;

use zhanshop\App;
use app\http\Controller;

class User extends Controller
{
    /**
     * 前置中间件
     * @var array
     */
    protected $beforeMiddleware = [];

    /**
     * 异步中间件
     * @var array
     */
    protected $asyMiddleware = [
    ];
    

     /**
     * 用户登陆
     * @apiGroup 用户中心
     * @return array
     */
    public function login(mixed &$request){
        $method = $request->post['_method'] ?? $request->server['request_method'];
        switch ($method){
            case "POST":
            $data = $request->service->postLogin($request);
            break;
            case "PUT":
            $data = $request->service->putLogin($request);
            break;
            case "DELETE":
            $data = $request->service->deleteLogin($request);
            break;
            default:
            $data = $request->service->getLogin($request);
        }
        return $data;;
    }
}