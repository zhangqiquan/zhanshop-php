<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / TreeFinder.php    [ 2023/5/16 13:44 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\finder;

use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

trait TreeFinder
{

    /**
     * 获取属性菜单列表
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function get(Request &$request, Response &$response){
        $inputData = $request->validateRule([
            'page' => 'int',
            'limit' => 'int',
            'search' => 'array',
            'parent_id' => 'string',
        ])->getData();
        $search = $inputData['search'] ?? [];
        if($inputData[$this->treeCustomName['pid']]){
            $search[] = [$this->treeCustomName['pid'], '=', (string)$inputData[$this->treeCustomName['pid']]];
            $inputData['page'] = 1;
            $inputData['limit'] = 30000;
        }else{
            $search[] = [$this->treeCustomName['pid'], '=', '0'];
        }
        $data =  $this->data($inputData['page'], $inputData['limit'], $search);
        if($data['list']){
            $parents = App::database()->model($this->menuData['table_names'][0])->whereIn($this->treeCustomName['pid'], array_column($data['list'], $this->treeCustomName['id']))->group($this->treeCustomName['pid'])->column($this->treeCustomName['pid'], $this->treeCustomName['pid']);
            foreach ($data['list'] as $k => $v){
                $data['list'][$k]['is_parent'] = false;
                if(in_array($v[$this->treeCustomName['id']], $parents)){
                    $data['list'][$k]['is_parent'] = true;
                }
                unset($data['list'][$k]['icon']);
            }
        }

        return $data;
    }

    /**
     * 删除子级
     * @param mixed $pid
     * @return void
     */
    protected function deleteChildren(mixed &$pdo, string $modelName, string $pk, array $pids){
        App::database()->model($modelName)->whereIn($pk, $pids)->delete($pdo); // 删除自身， 还要删除它的子级别

        // 拿到它的所有子级Id
        $pids = App::database()->model($modelName)->whereIn($this->treeCustomName['pid'], $pids)->column($pk, $pk);
        if($pids){
            $this->deleteChildren($pdo, $modelName, $pk, $pids);
        }
    }

    /**
     * 删除树形表格主表的数据，暂未实现多关系表的删除
     * @param Request $request
     * @return array
     */
    public function delete(Request &$request, Response &$response){
        $input = $request->post();
        App::database()->transaction(function(mixed $pdo) use ($input){
            foreach($this->menuData['table_names'] as $k => $v){
                if($k == 0){
                    // 暂时只能做到删除主表 子表的关系可能无法确定 需要手动手写删除方法
                    $this->deleteChildren($pdo, $v, $this->menuData['pk'], $input['pk']);
                }
            }
        });
        return [];
    }
}