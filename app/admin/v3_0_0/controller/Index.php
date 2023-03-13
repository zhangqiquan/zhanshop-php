<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Index.php    [ 2023/2/27 9:02 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\controller;

use app\admin\Controller;
use app\admin\v3_0_0\middleware\Authenticate;
use zhanshop\App;
use zhanshop\Request;

class Index extends Controller
{
    protected $beforeMiddleware = [
        Authenticate::class,
    ];

    public function index(Request &$request){
        $data = $this->restful($request, false);
        return $data;
    }

    public function main(Request &$request){
        $data = $this->restful($request, false);
        return $data;
    }

    public function user(Request &$request){
        $data = $this->restful($request, false);
        return $data;
    }

    public function config(Request &$request){
        $data = $this->finder($request);
        return $data;
    }

    public function table(Request &$request){
        $data = $this->finder($request);
        return $data;
    }

    public function ping(Request &$request){
        return [];
    }
}