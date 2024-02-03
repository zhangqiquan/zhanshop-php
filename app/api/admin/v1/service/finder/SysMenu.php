<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / sys_menu.php    [ 2023/2/28 20:22 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\finder;

use app\api\admin\v1\service\common\Menu;
use zhanshop\App;
use zhanshop\Error;
use zhanshop\Helper;
use zhanshop\Request;
use zhanshop\Response;
use zhanshop\service\SchemaService;

class SysMenu extends BaseFinder
{
    use TreeFinder;
    protected $headToolbar = [
        [
            'event' => 'add',
            'ico' => '&#xe608;',
            'title' => '添加',
            'method' => '',
            'page' => './table/add.html',
        ],
        [
            'event' => 'deletes',
            'ico' => '&#xe640;',
            'title' => '删除',
            'method' => '',
            'page' => '',
        ],
    ];

    protected $rowToolbar = [
        [
            'title' => '编辑',
            'event' => 'edit',
            'templet' => '<div><i class="layui-icon">&#xe642;</i>&nbsp;&nbsp;<span class="text">编辑</span></div>',
            'method' => '',
            'page' => './table/edit.html',
        ],
        [
            'title' => '更新结构',
            'event' => 'ajax',
            'templet' => '<div><i class="layui-icon">&#xe639;</i>&nbsp;&nbsp;<span class="text">{{= d.title }}</span></div>',
            'method' => 'schema',
            'page' => '',
        ],
        [
            'title' => '删除',
            'event' => 'delete',
            'templet' => '<div><i class="layui-icon">&#xe640;</i>&nbsp;&nbsp;<span class="text">{{= d.title }}</span></div>',
            'method' => '',
            'page' => '',
        ],
    ];

    /**
     * 获取添加表单页面数据
     * @param Request $request
     * @return array
     */
    public function addfrom(Request &$request, Response &$response){
        $data = [];
        $schemaDir = App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR;
        foreach($this->menuData['table_names'] as $k => $v){
            $include = $this->getCols($v);
            //$include = include $schemaDir.$v.'.php';
            unset($include['create_time'], $include['update_time'], $include['delete_time']);

            $data[] = [
                'title' => '-',
                'step' => $k,
                'table_name' => $v,
                'schema' => $include
            ];
        }
        return $data;
    }

    /**
     * 处理添加请求
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function post(Request &$request, Response &$response)
    {
        $post = $request->post('0');
        $id = str_replace([' ', '-'], '_', $post['id']);
        $post['id'] = ucfirst(Helper::camelize($id)); // 转驼峰
        if($post['table_names']){
            $arr = explode(",", $post['table_names']);
            foreach ($arr as $k => $v){
                if($v){
                    $data = SchemaService::create($v);
                    if($k == 0) $post['pk'] = current($data)['field'];
                }
            }
        }
        $post['create_time'] = time();
        try {
            $post['pk'] = $post['pk'] ? $post['pk'] : 'id';
            App::database()->model('system_menu')->insert($post);
        }catch (\Throwable $e){
            App::error()->setError('菜单添加失败!请检查菜单id是否重复', 403);
        }
        return [];
    }

    /**
     * 处理更新请求
     * @param Request $request
     * @return array|void
     * @throws \Exception
     */
    public function put(Request &$request, Response &$response)
    {
        $post = $request->post('0');
        if($post['table_names']){
            $arr = explode(",", $post['table_names']);
            foreach ($arr as $k => $v){
                if($v){
                    $data = SchemaService::create($v);
                    if($k == 0) $post['pk'] = current($data)['field'];
                }
            }
        }
        $post['pk'] = $post['pk'] ? $post['pk'] : 'id';
        App::database()->model('system_menu')->where(['id' => $request->get('pk')])->update($post);
        $data = $this->data(1, 1, [[$this->menuData['pk'], '=', $request->get('pk')]]);
        unset($data['list'][0]['icon']);
        return $data;
    }

    /**
     * 更新菜单对应的表schema
     * @param Request $request
     * @return array
     */
    public function schema(Request &$request, Response &$response){
        $input = $request->validateRule([
            'id' => 'Required',
        ])->getData();

        $tables = App::database()->model("system_menu")->where(['id' => $input['id']])->value('table_names');
        if($tables){
            $tables = explode(',', $tables);
            foreach($tables as $v){
                SchemaService::create($v);
            }
        }
        return [];
    }

    /**
     * 级联数据
     * @param Request $request
     * @return array|mixed
     * @throws \Exception
     */
    public function cascader(Request &$request, Response &$response){
        $menuVal = $request->get('value_menu');
        $menuData = App::database()->model('system_menu')->where(['id' => $menuVal])->find();
        //var_dump($menuData);
        if($menuData == false) App::error()->setError($menuVal.'的菜单信息不存在', 404);
        $menuData['table_names'] = explode(',', $menuData['table_names']);
        $tableName = $menuData['table_names'][0] ?? App::error()->setError($menuData['id'].'的table_names未指定', 404);
        if($menuData['pk'] == false || $menuData['name'] == false || $menuData['pid'] == false) App::error()->setError($menuData['id'].'的pk,name,pid未完善', 404);
        $data = App::database()->model($tableName)->where(['target' => '_self'])->field($menuData['pk'].' as value,'.$menuData['name'].' as label,'.$menuData['pid'].' as pid')->select();

        foreach($data as $k => $v){
            if($v['pid'] == 0){
                $id = $v['value'];
                unset($data[$k], $v['pid']);
                $this->cascaders[$id] = $v;
                $this->getChildCascader($this->cascaders[$id], $data, $id);
            }
        }
        return array_values($this->cascaders);
    }
}