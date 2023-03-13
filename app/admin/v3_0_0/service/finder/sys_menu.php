<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / sys_menu.php    [ 2023/2/28 20:22 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\service\finder;

use app\admin\v3_0_0\service\common\Menu;
use zhanshop\App;
use zhanshop\Error;
use zhanshop\Request;

class sys_menu extends basefinder
{
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
            'event' => 'edit',
            'ico' => '&#xe642;',
            'title' => '编辑',
            'method' => '',
            'page' => './table/edit.html',
        ],
        [
            'event' => 'ajax',
            'ico' => '&#xe642;',
            'title' => '更新结构',
            'method' => 'schema',
            'page' => '',
        ],
        [
            'event' => 'delete',
            'ico' => '&#xe640;',
            'title' => '删除',
            'method' => '',
            'page' => '',
        ],
    ];

    public function addfromtable(Request &$request){
        $data = [];
        $schemaDir = App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR;
        foreach($this->menuData['table_names'] as $v){
            $include = $this->getCols($v);
            //$include = include $schemaDir.$v.'.php';
            unset($include['create_time'], $include['update_time'], $include['delete_time']);

            $data[] = [
                'title' => '-',
                'table_name' => $v,
                'schema' => $include
            ];
        }
        return $data;
    }


    public function gettable(Request &$request){
        $page = $request->post('page', '1');
        $limit = $request->post('limit', '20');
        $search = $request->post('search', []);
        $data =  $this->data((int)$page, (int)$limit, $search);
        if($data['data']){
            $ids = array_column($data['data'], 'id');
            $parents = App::database()->model("system_menu")->whereIn('parent_id', $ids)->group("parent_id")->column('parent_id', 'parent_id');
            foreach ($data['data'] as $k => $v){
                if(isset($parents[$v['id']])) $data['data'][$k]['haveChild'] = true;
            }
        }

        return $data;
    }

    public function posttable(Request &$request)
    {
        $post = $request->post('system_menu');
        if($post['table_names']){
            $arr = explode(",", $post['table_names']);
            foreach ($arr as $k => $v){
                if($v){
                    $data = $this->schema($v);
                    if($k == 0) $post['pk'] = current($data)['field'];
                }
            }
        }
        $post['create_time'] = time();
        try {
            App::database()->model('system_menu')->insert($post);
        }catch (\Throwable $e){
            App::error()->setError('菜单添加失败!请检查菜单id是否重复', 403);
        }
        return [];
    }

    public function puttable(Request &$request)
    {
        $post = $request->post('system_menu');
        if($post['table_names']){
            $arr = explode(",", $post['table_names']);
            foreach ($arr as $k => $v){
                if($v){
                    $data = $this->schema($v);
                    if($k == 0) $post['pk'] = current($data)['field'];
                }
            }
        }
        App::database()->model('system_menu')->where(['id' => $request->get('pk')])->update($post);
        return [];
    }

    public function schematable(Request &$request){
        $input = App::validate()->check($request->post(), [
            'id' => 'Required',
        ]);
        $tables = App::database()->model("system_menu")->where(['id' => $input['id']])->value('table_names');
        if($tables){
            $tables = explode(',', $tables);
            foreach($tables as $v){
                $oldschema = [];
                $schemaFile = App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR.$v.'.php';
                if(file_exists($schemaFile)){
                    $oldschema = include $schemaFile;
                }
                $schema = $this->schema($v);
                foreach($schema as $kk => $vv){
                    if(isset($oldschema[$kk])){
                        $schema[$kk]['search'] = $oldschema[$kk]['search'] ?? $vv['search'];
                        $schema[$kk]['value'] = $oldschema[$kk]['value'] ?? $vv['value'];
                        $schema[$kk]['in_list'] = $oldschema[$kk]['in_list'] ?? $vv['in_list'];
                        $schema[$kk]['in_field'] = $oldschema[$kk]['in_field'] ?? $vv['in_field'];
                        $schema[$kk]['width'] = $oldschema[$kk]['width'] ?? $vv['width'];
                        $schema[$kk]['value_menu'] = $oldschema[$kk]['value_menu'] ?? $vv['value_menu'];
                        $schema[$kk]['input_type'] = $oldschema[$kk]['input_type'] ?? $vv['input_type'];
                    }
                }
                file_put_contents($schemaFile, "<?php\n return ".var_export($schema, true).';');
            }
        }
        return [];
    }

    protected function schema(string $table){
        $data = App::database()->model($table)->query('SHOW FULL COLUMNS FROM '.$table);
        $schemaData = [];
        foreach($data as $v){
            $maxlength = 0;
            $types = explode('(', $v['Type']);
            if(isset($types[1])){
                $maxlength = intval(explode(')', $types[1])[0]);
            }
            $schemaData[$v['Field']] = [
                'field' => $v['Field'],
                'type' => explode(' ', $v['Type'])[0],
                'key' => strtolower($v['Key']),
                'null' => strtolower($v['Null']),
                'default' => $v['Default'],
                'title' => $v['Comment'] ? $v['Comment'] : $v['Field'],
                'search' => false,
                'value' => [],
                'in_list' => true,
                'in_field' => true,
                'width' => 120,
                'value_menu' => '',
                'input_type' => 'text',
                'input_maxlength' => $maxlength,
            ];
        }
        $schemaFile = App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR.$table.'.php';
        if(!file_exists($schemaFile)){
            //print_r($schemaData);
            file_put_contents($schemaFile, "<?php\n return ".var_export($schemaData, true).';');
        }
        return $schemaData;
    }

    public function cascadertable(Request &$request){
        $input = App::validate()->check($request->get(), [
            'value_menu' => 'Required',
        ]);
        $menuData = App::database()->model('system_menu')->where(['id' => $input['value_menu']])->find();
        //var_dump($menuData);
        if($menuData == false) App::error()->setError($input['value_menu'].'的菜单信息不存在', 404);
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