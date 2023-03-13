<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / goods_category.php    [ 2023/3/2 20:18 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\service\finder;

use zhanshop\App;
use zhanshop\Request;

class goods_category extends basefinder
{
    public function gettable(Request &$request){
        $page = $request->post('page', '1');
        $limit = $request->post('limit', '20');
        $search = $request->post('search', []);
        $data =  $this->data((int)$page, (int)$limit, $search);
        if($data['data']){
            $ids = array_column($data['data'], 'cat_id');
            $parents = App::database()->model("goods_category")->whereIn('parent_id', $ids)->group("parent_id")->column('parent_id', 'parent_id');
            foreach ($data['data'] as $k => $v){
                if(isset($parents[$v['cat_id']])) $data['data'][$k]['haveChild'] = true;
            }
        }

        return $data;
    }
}