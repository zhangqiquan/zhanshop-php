<?php

namespace app\helper;

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