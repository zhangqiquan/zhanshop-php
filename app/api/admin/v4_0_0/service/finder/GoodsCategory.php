<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / goods_category.php    [ 2023/3/2 20:18 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\service\finder;

use zhanshop\App;
use zhanshop\Request;

class GoodsCategory extends BaseFinder
{
    protected $treeCustomName = [
        'id' => 'cat_id',
        'name' => 'cat_name',
        'pid' => 'parent_id',
        'isParent' => 'is_parent',
        'children' => 'children',
    ];

    use TreeFinder;
}