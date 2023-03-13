<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Passport.php    [ 2023/3/7 10:40 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\http\v1_0_0\controller;
use app\http\Controller;
use zhanshop\Request;

class Passport extends Controller
{
    /**
     * 用户登录
     * @apiGroup 用户中心
     * @return array
     */
    public function login(Request &$request){
        $data = $this->restful($request, false);
        return $data;
    }
}