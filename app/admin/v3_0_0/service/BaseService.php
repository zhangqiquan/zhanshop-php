<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / BaseService.php    [ 2023/2/26 16:46 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\service;

use app\admin\v3_0_0\service\common\SchmaData;
use app\admin\v3_0_0\service\finder\basefinder;
use zhanshop\App;
use zhanshop\Helper;

class BaseService{

    protected function setRoleMenu(int $roleId, array $menuIds){
        App::cache()->set('rolemenu:'.$roleId, json_encode($menuIds));
    }

    public function roleVerify(int $roleId, string $menuId){
        $rolemenu = App::cache()->get('rolemenu:'.$roleId);
        if($rolemenu == false) App::error()->setError('没有可匹配的菜单权限', 403);
        $rolemenu = json_decode($rolemenu, true);
        if($rolemenu && in_array($menuId, $rolemenu)) return true;
        App::error()->setError('没有可匹配的菜单权限', 403);
    }

    public function getFinder(string $menuId){
        // 菜单权限检查
        $finderPath = __DIR__.DIRECTORY_SEPARATOR.'finder'.DIRECTORY_SEPARATOR.$menuId.'.php';
        if(!file_exists($finderPath)){
            $finder = new basefinder($menuId);
        }else{
            $class = get_called_class();
            $dir = substr($class,0, strrpos($class, '\\'));
            $class = $dir.'\\finder\\'.$menuId;
            $finder = new $class($menuId);
        }
        return $finder;
    }

    protected $menuData;
    public function init(string $menuId){
        $this->menuData = App::database()->model("system_menu")->where(['id' => $menuId])->field('id,title,table_names,pk,name,pid')->find();
        if($this->menuData == false) App::error()->setError('菜单:'.$menuId.',不存在', 404);
        $this->menuData['table_names'] = explode(',', $this->menuData['table_names']);
        return $this;
    }

    public $menuId;
    protected $finder = [];

    public function finder(string $menuId){
        $this->menuId = $menuId;
        if(isset($this->finder[$this->menuId])) return $this->finder[$this->menuId];
        $finderClass = ucfirst(Helper::camelize(str_replace('-', '_', $menuId)));
        $finderPath = __DIR__.DIRECTORY_SEPARATOR.'finder'.DIRECTORY_SEPARATOR.$finderClass.'.php';
        if(isset($this->finder[$this->menuId]) == false && file_exists($finderPath)){
            $class = get_called_class();
            $dir = substr($class,0, strrpos($class, '\\'));
            $class = $dir.'\\finder\\'.$finderClass;
            $finder = new $class();
            $finder->menuId = $menuId;
            $this->finder[$menuId] = $finder;
            return $finder;
        }

        return $this;
    }

    public function getList(string $table, array $where, string $relkey, string $whereRaw = ''){
        $model = App::database()->table($table);
        unset($where['page'], $where['limit']);
        // 主表的单条搜索
        if($where){
            foreach ($where as $k => $v){
                if($k == $relkey && $v){
                    $model = $model->where([$k =>$v]);
                }else{
                    if($v != ''){
                        $model = $model->whereLike($k, '%'.$v.'%');
                    }
                }
            }
        }

        if($whereRaw) $model = $model->whereRaw($whereRaw);
        $schma = SchmaData::getSchma($this->menuId, $table);
        if($schma['orderby']){
            $orders = explode(',', $schma['orderby']);
            $model = $model->order($orders[0].' '.$orders[1]);
        }else{
            $model = $model->order($relkey.' desc');
        }
        return [
            'total' => $model->count(),
            'current_page' => 1,
            'data' => $model->select()
        ];
        $data = $model->finder(1, 20);
        return $data;
    }
}