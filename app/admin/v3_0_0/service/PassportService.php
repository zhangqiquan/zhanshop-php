<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / PassportService.php    [ 2023/3/4 22:08 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\service;

use app\admin\v3_0_0\service\plugin\Password;
use zhanshop\App;

class PassportService
{
    public function login(string $username, string $password, string $ip, string $agent){
        $cacheKey = 'login:limit:'.$ip;
        $cache = App::cache()->instance();
        $errNum = $cache->get($cacheKey);
        if($errNum >= 5) App::error()->setError('当前IP账户或者密码错误超过5次,已被限制登录', 403);
        $user = App::database()->model("system_user")->where(['user_name' => $username])->find(); // 数据模型测试代码
        if($user &&  Password::hashVerify($password, $username, $user['password'])){
            // 后面是失效时间
            if($user['enabled'] == false) App::error()->setError("账号已被管理员禁用", 403);
            // 是否演示账号
            $user['token'] = App::aes()->encrypt($user['user_id'].','.$user['role_id'].','.$user['is_demo'].','.$ip.','.md5($agent));
            unset($user['password']);
            // 更新用户登陆信息
            App::database()->model("system_user")->where(['user_id' => $user['user_id']])->update([
                'last_login_ip' => $ip,
                'last_login_time' => time(),
                'login_count' => App::database()->raw('login_count+1'),
            ]);
            App::cache()->hSet('admin', strval($user['user_id']), time()); // 记录后台用户的最后时间
            return $user;
        }
        if($errNum == false) $cache->set($cacheKey, 0, 600);
        $cache->incr($cacheKey, 1);
        App::error()->setError("账号或密码错误", 403);
    }
}