<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / PassportService.php    [ 2023/3/4 22:08 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service;

use app\api\admin\v1\middleware\Authenticate;
use app\helper\Password;
use app\constant\Auth;
use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

class PassportService
{

    /**
     * 用户登录
     * @param array $param
     * @return array|mixed|void
     * @throws \RedisException
     */
    public function postLogin(array $param){
        $cacheKey = Authenticate::ADMIN_AUTH_KEY.':limit:'.$param['remote_addr'];
        $cache = App::cache();
        $errNum = $cache->get($cacheKey);

        App::error()->assert($errNum < 5, '账户或者密码错误超过5次,请稍后再试', Auth::USER_PWDERR_LIMIT);

        $user = App::database()->model("system_user")->where(['user_name' => $param['user_name']])->find();
        if($user &&  Password::hashVerify($param['password'], $param['user_name'], $user['password'])){

            App::error()->assert($user['enabled'], '账号已被管理员禁用', Auth::USER_FORBIDDEN);
            // 是否演示账号
            $user['token'] = App::aes()->encrypt($user['user_id'].','.$user['role_id'].','.$user['is_demo'].','.$param['remote_addr'].','.md5($param['user-agent']));
            unset($user['password']);
            // 更新用户登陆信息
            App::database()->model("system_user")->where(['user_id' => $user['user_id']])->update([
                'last_login_ip' => $param['remote_addr'],
                'last_login_time' => time(),
                'login_count' => App::database()->raw('login_count+1'),
            ]);
            App::cache()->set(Authenticate::ADMIN_AUTH_KEY.$user['user_id'], $param['time'], Authenticate::TOKEN_EXPIRE);
            return $user;
        }
        if($errNum == false) $cache->set($cacheKey, 0, 600);
        $cache->incr($cacheKey, 1);
        App::error()->setError("账号或密码错误", Auth::USER_PASSWORD_ERR);
    }

    public function postLogin1(Request &$request, Response &$response){
        $data = $request->validate([
            'user_name' => 'required',
            'password' => 'required',
            'remote_addr' => '',
            'user-agent' => '',
        ])->getData();

        $data['remote_addr'] = $request->server('remote_addr');
        $data['user-agent'] = $request->header('user-agent', "");

        $cacheKey = Authenticate::ADMIN_AUTH_KEY.':limit:'.$data['remote_addr'];
        $cache = App::cache();
        $errNum = $cache->get($cacheKey);

        App::error()->assert($errNum < 5, '账户或者密码错误超过5次,请稍后再试', Auth::USER_PWDERR_LIMIT);

        $user = App::database()->model("system_user")->where(['user_name' => $data['user_name']])->find();
        if($user &&  Password::hashVerify($data['password'], $data['user_name'], $user['password'])){

            App::error()->assert($user['enabled'], '账号已被管理员禁用', Auth::USER_FORBIDDEN);
            // 是否演示账号
            $user['token'] = App::aes()->encrypt($user['user_id'].','.$user['role_id'].','.$user['is_demo'].','.$data['remote_addr'].','.md5($data['user-agent']));
            unset($user['password']);
            // 更新用户登陆信息
            App::database()->model("system_user")->where(['user_id' => $user['user_id']])->update([
                'last_login_ip' => $data['remote_addr'],
                'last_login_time' => time(),
                'login_count' => App::database()->raw('login_count+1'),
            ]);
            App::cache()->set(Authenticate::ADMIN_AUTH_KEY.$user['user_id'], $request->time(), Authenticate::TOKEN_EXPIRE);
            return $user;
        }
        if($errNum == false) $cache->set($cacheKey, 0, 600);
        $cache->incr($cacheKey, 1);
        App::error()->setError("账号或密码错误", Auth::USER_PASSWORD_ERR);
    }
}