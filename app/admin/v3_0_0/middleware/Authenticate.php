<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Authenticate.php    [ 2023/2/27 12:27 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\middleware;

use zhanshop\App;
use zhanshop\Request;

class Authenticate
{
    public function handle(Request &$request){
        $token = $request->header('token');
        if($token == false) App::error()->setError('请先登陆', 10001);
        $users = App::aes()->decrypt($token);
        if($users == false) App::error()->setError('用户token无效', 403);
        $arr = explode(',', $users);
        if($arr[3] != $request->server('remote_addr') || $arr[4] != md5($request->header('user-agent', ""))) App::error()->setError('设备信息或ip发生变登录信息失效', 10002);
        $userId = $arr[0];
        // 记录这个用户的访问时间 如果这个用户id不在redis中提示非法
        $userTime = App::cache()->hGet('admin', $userId);
        if($userTime == false || ($request->time() - 600) > $userTime){
            App::error()->setError("由于长时间没有操作,已超时退出", 10002);
        }

        App::cache()->hSet('admin', $userId, $request->time());
        $roleId = $arr[1];
        $isDemo = $arr[2];
        // 验证是否演示账号
        if($arr[2] == 1){
            $filters = ['uploadtoken', 'put', 'delete'];
            if($request->method(true) == 'POST' &&  ($request->post('_method') == false || in_array($request->method(), $filters))){
                App::error()->setError('演示账号禁止添加、删除、修改、上传数据', 10003);
            }
        }
        $request->setExt('user.user_id', $userId);
        $request->setExt('user.role_id', $roleId);
        $request->setExt('user.is_demo', $isDemo);
        return $userId;
    }
}