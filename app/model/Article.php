<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / article.php [ 2023/2/14 下午5:28 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\model;

use zhanshop\database\Model;

class article extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'article';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';


}