<?php
// +----------------------------------------------------------------------
// | framework / Index.php    [ 2022/12/30 11:43 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2022 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\http\v1_0_0\controller;

// 全部采用post请求
use zhanshop\apidoc\ApiDocController;

class Index extends ApiDocController
{
    /**
     * 前置中间件
     * @var array
     */
    protected $beforeMiddleware = [
    ];

    /**
     * 后置中间件
     * @var array
     */
    protected $afterMiddleware = [
    ];

    public function doc(mixed &$request){

    }

    public function hello(mixed &$request){
        return "hello";
    }
}