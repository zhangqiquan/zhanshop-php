<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Test.php    [ 2023/5/13 14:22 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\task;

use zhanshop\App;

class Test
{
    public static function echo($a, $b, $c){
        // 测试在task和定时任务进程里面操作数据库和redis
        var_dump($a, $b, $c);
    }
}