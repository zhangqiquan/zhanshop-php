<?php
// +----------------------------------------------------------------------
// | flow-admin / Password.php    [ 2021/11/22 5:02 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v1\service\plugin;

class Password
{
    /**
     * 哈希加密
     * @param string $password
     * @param string $salt
     */
    public static function hashEncode(string $password, string $salt){
        $password = sha1(sha1(sha1($salt.$password)));
        return password_hash($password , PASSWORD_DEFAULT);
    }

    /**
     * 哈希验证
     * @param string $password
     * @param string $salt
     * @param string $hash
     * @return boolean
     */
    public static function hashVerify(string $password, string $salt, string $hash){
        $password = sha1(sha1(sha1($salt.$password)));
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }
}