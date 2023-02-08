<?php
// +----------------------------------------------------------------------
// | zhanshop-php / CourseLesson.php [ 2023/1/16 下午6:36 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\model;

use zhanshop\database\Model;

class Test extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'test';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    public function echo(){
        return 1;
    }
}