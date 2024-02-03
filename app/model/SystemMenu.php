<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / SystemMenu.php [ 2023/2/20 下午5:47 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\model;

use zhanshop\App;
use zhanshop\database\Model;

class SystemMenu extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'system_menu';

    // 设置当前模型的数据库连接
    protected $connection = 'mysql';

    protected $targets = [
        'table' => 'table/',
        'simple-list' => 'simple-list/',
        'treetable' => 'treetable/',
        'finder' => 'table/',
        'audio' => 'audio/',
        'video' => 'video/',
        'image' => 'image/',
        'config' => 'config/'
    ];


    public function schema($model){
        $field = include App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR.$model.'.php';
        return $field;
    }

    public function searchSchema($model){
        $field = include App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR.$model.'.php';
        foreach ($field as $k => $v){
            if(in_array($v['input_type'], ['date', 'time'])){
                $field[$k]['input_type'] = 'timerange';
            }
        }
        return $field;
    }

    public function get(int $roleId = 0){
        $data = [];
        if($roleId){
            $menus = App::database()->model("system_role")->where(['role_id' => $roleId])->value('menus');
            if($menus){
                $menus = json_decode($menus, true);
                if($menus){
                    $data = $this->limit(5000)->field('id,title as name,parent_id as pid,icon,target,page as url')->where(['is_hidden' => 0])->whereIn('id', $menus)->order('sortrank asc')->order('create_time', 'desc')->select();
                }
            }
        }else{
            $data = $this->limit(5000)->field('id,title as name,parent_id as pid,icon,target,page as url')->where(['is_hidden' => 0])->order('sortrank asc')->order('create_time', 'desc')->select();
        }

        foreach ($data as $k => $v){
            if($v['url'] == false) $data[$k]['url'] = isset($this->targets[$v['target']]) ? $this->targets[$v['target']].$v['id'] : '';
        }
        return $data;
    }
}