<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / PassportService.php    [ 2023/3/4 22:08 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\service;

use app\api\admin\v4_0_0\middleware\Authenticate;
use app\helper\Password;
use app\constant\Auth;
use zhanshop\App;

class PassportService
{
    public function login(string $username, string $password, string $ip, string $agent){
        $cacheKey = Authenticate::ADMIN_AUTH_KEY.':limit:'.$ip;
        $cache = App::cache();
        $errNum = $cache->get($cacheKey);

        App::error()->assert($errNum < 5, '账户或者密码错误超过5次,请稍后再试', Auth::USER_PWDERR_LIMIT);

        $user = App::database()->model("system_user")->where(['user_name' => $username])->find(); // 数据模型测试代码
        if($user &&  Password::hashVerify($password, $username, $user['password'])){

            App::error()->assert($user['enabled'], '账号已被管理员禁用', Auth::USER_FORBIDDEN);
            // 是否演示账号
            $user['token'] = App::aes()->encrypt($user['user_id'].','.$user['role_id'].','.$user['is_demo'].','.$ip.','.md5($agent));
            unset($user['password']);
            // 更新用户登陆信息
            App::database()->model("system_user")->where(['user_id' => $user['user_id']])->update([
                'last_login_ip' => $ip,
                'last_login_time' => time(),
                'login_count' => App::database()->raw('login_count+1'),
            ]);
            return $user;
        }
        if($errNum == false) $cache->set($cacheKey, 0, 600);
        $cache->incr($cacheKey, 1);
        App::error()->setError("账号或密码错误", Auth::USER_PASSWORD_ERR);
    }
}