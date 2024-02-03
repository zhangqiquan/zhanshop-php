<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Passport.php    [ 2023/3/4 21:38 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\controller;

use app\api\admin\Controller;
use app\api\admin\v1\service\PassportService;
use app\api\admin\v1\validate\PassportPostLogin;
use app\task\AndroidBossExpectJobTask;
use zhanshop\App;
use zhanshop\console\TaskManager;
use zhanshop\Request;
use zhanshop\Response;

class Passport extends Controller
{
    /**
     * @api POST login 后台登陆
     * @apiParam string user_name 用户名
     * @apiParam string password 密码
     * @apiSuccess string user_name 用户名
     * @apiSuccess string avatar 用户头像
     * @apiSuccess string token 用户token
     * @apiGroup 后台管理
     * @apiDescription 登录到后台的接口
     */
    public function postLogin(Request &$request, Response &$response){
        $data = $request->validateRule([
            'user_name' => 'Required',
            'password' => 'Required | length:6:32',
        ],[
            'user_name' => '用户名',
            'password' => '密码',
        ])->getData();
        $data['remote_addr'] = $request->server('remote_addr');
        $data['user-agent'] = $request->header('user-agent', "");
        $data['time'] = $request->time();
        $ret = App::make(PassportService::class)->postLogin($data);
        return $this->result($ret);
    }
}