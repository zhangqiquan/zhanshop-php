<?php
// +----------------------------------------------------------------------
// | User控制器【系统生成】   [ 2023-03-09 09:34:22 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace app\http\v1_0_0\controller;

use zhanshop\Request;
use app\http\Controller;

class User extends Controller
{
    

     /**
     * 用户信息
     * @apiGroup 用户中心
     * @return array
     */
    public function info(Request &$request){
        $data = $this->restful($request, false);
        return $data;
    }
}