<?php
// +----------------------------------------------------------------------
// | zhanshop_admin / Auth.php [ 2023/4/21 下午10:41 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\constant;

class Auth
{
    // token缺失
    const TOKEN_MISSING = 10001;

    // token不合法
    const TOKEN_ILLEGAL = 10002;

    // token失效
    const TOKEN_EXPIRE = 10003;

    // token验证失败
    const TOKEN_FAILED = 10004;

    // 用户被禁止登陆
    const USER_FORBIDDEN = 10010;

    // 用户密码错误上限
    const USER_PWDERR_LIMIT = 10011;

    // 用户秘密错误
    const USER_PASSWORD_ERR = 10012;
}