<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / SysRegion.php    [ 2023/6/14 下午9:22 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\service\finder;

class SysRegion extends BaseFinder
{
    protected $treeCustomName = [
        'id' => 'id',
        'name' => 'name',
        'pid' => 'parent_id',
        'isParent' => 'is_parent',
        'children' => 'children',
    ];

    use TreeFinder;
}