<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Index.php    [ 2023/2/27 9:02 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\controller;

use app\api\admin\Controller;
use app\api\admin\v4_0_0\middleware\Authenticate;
use zhanshop\Request;
use zhanshop\Response;

class Index extends Controller
{
    protected $beforeMiddleware = [
        Authenticate::class,
    ];

    public function index(Request &$request, Response &$response){
        $data = $this->restful($request, $response);
        return $this->result($data);
    }

    public function main(Request &$request, Response &$response){
        $data = $this->restful($request, $response);
        return $this->result($data);
    }

    public function user(Request &$request, Response &$response){
        $data = $this->restful($request, $response);
        return $this->result($data);
    }

    public function config(Request &$request, Response &$response){
        $data = $this->finder($request, $response);
        return $this->result($data);
    }

    public function table(Request &$request, Response &$response){
        $data = $this->finder($request, $response);
        return $this->result($data);
    }

    public function plugin(Request &$request, Response &$response){
        $data = $this->restful($request, $response);
        return $data;
    }

    public function ping(Request &$request, Response &$response){
        $data = [];
        return $this->result($data, $response);
    }

    public function test(Request &$request, Response &$response){
        //$response->header('Content-Type', 'application/octet-stream');
        $response->header('Content-Type', 'text/html');
        $response->header('Content-Disposition', 'attachment; filename="1.html"');
        $response->write("1111111");
    }
}