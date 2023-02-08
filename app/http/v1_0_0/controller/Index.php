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

use app\http\Controller;
use app\http\v1_0_0\middleware\RequestLog;
use zhanshop\App;

// 全部采用post请求
class Index extends Controller
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
        RequestLog::class
    ];

    public function index(mixed &$request){
        return "123";
    }
}