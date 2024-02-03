<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Authenticate.php    [ 2023/2/27 12:27 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\middleware;

use app\constant\Auth;
use zhanshop\App;
use zhanshop\Error;
use zhanshop\Request;
use zhanshop\Response;

class AdminAuth
{
    const TOKEN_EXPIRE = 600; // token失效时间
    const ADMIN_AUTH_KEY = 'admin:user:login:';
    public function handle(Request &$request, \Closure &$next){
        $token = $request->header('token');
        if($token == false){
            $token = $request->get('_token');
            if($token) $token = str_replace([' '], ['+'], $token);
        }
        App::error()->assert($token, 'header token缺失', Auth::TOKEN_MISSING);

        $users = App::aes()->decrypt($token);

        App::error()->assert($users, 'token 无效', Auth::TOKEN_ILLEGAL);

        $users = explode(',', $users);

        if($users[3] != $request->server('remote_addr') || $users[4] != md5($request->header('user-agent', ""))){
            App::error()->setError('token验证失败', Auth::TOKEN_FAILED);
        }

        // 拿到用户信息
        $userId = $users[0];
        // 记录这个用户的访问时间 如果这个用户id不在clientInfo中提示非法
        $authCache = App::cache();
        $authKey = self::ADMIN_AUTH_KEY.$userId;
        $userTime = (int)$authCache->get($authKey);

        if($request->time() - self::TOKEN_EXPIRE > $userTime) App::error()->setError('token已失效', Auth::TOKEN_EXPIRE);

        $authCache->set($authKey, $request->time(), self::TOKEN_EXPIRE);

        $roleId = $users[1];
        $isDemo = $users[2];
        // 验证是否演示账号
        if($users[2] == 1){
            $filters = ['uploadtoken', 'post', 'put', 'delete', false];
            $method = strtolower($request->method());
            if($request->method(true) == 'POST' &&  in_array($method, $filters)){
                App::error()->setError('演示账号禁止添加、删除、修改、上传数据', Error::FORBIDDEN);
            }
        }
        $request->setData('user.user_id', $userId);
        $request->setData('user.role_id', $roleId);
        $request->setData('user.is_demo', $isDemo);

        return $next($request);
    }
}