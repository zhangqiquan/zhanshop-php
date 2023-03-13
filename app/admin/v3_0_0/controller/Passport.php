<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Passport.php    [ 2023/3/4 21:38 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\controller;

use app\admin\Controller;
use app\admin\v3_0_0\service\IndexService;
use app\admin\v3_0_0\service\PassportService;
use zhanshop\App;
use zhanshop\Request;

class Passport extends Controller
{
    public function login(Request &$request){
        $input = &App::validate()->check($request->post(), [
            'user_name' => 'Required',
            'password' => 'Required',
        ]);
        $service = new PassportService();
        return $service->login($input['user_name'], $input['password'], $request->server('remote_addr'), $request->header('user-agent', ""));
    }
}