<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / basefinder.php    [ 2023/2/27 19:41 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\service\finder;

use app\admin\v3_0_0\service\common\Menu;
use zhanshop\App;
use zhanshop\Request;

class basefinder
{
    protected $width = 'auto';
    protected $height = 'full-150';
    protected $skin = 'row';
    protected $size = 'sm';
    protected $even = true;
    protected $css = '';
    protected $limits = [20, 50, 100, 200, 500, 1000, 2000];
    protected $lineStyle = '';
    protected $cellMinWidth = '60';
    protected $data = null;
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
            'event' => 'delete',
            'ico' => '&#xe640;',
            'title' => '删除',
            'method' => '',
            'page' => '',
        ],
    ];

    protected $tabs = [];

    protected $menuData;
    public function __construct(string $menuId)
    {
        $this->menuData = App::database()->model("system_menu")->where(['id' => $menuId])->field('id,title,table_names,pk,name,pid')->find();
        if($this->menuData == false) App::error()->setError('菜单:'.$menuId.',不存在', 404);
        $this->menuData['table_names'] = explode(',', $this->menuData['table_names']);
    }

    public function editfromconfig(Request &$request){
        App::error()->setError($this->menuData['id'].'菜单editfromconfig尚未申明', 403);
    }

    protected function getCols(string $schma){
        $schemaDir = App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR;
        $include = include $schemaDir.$schma.'.php';
        unset($include['delete_time']);
        $outType = [];//['cascader'];
        foreach($include as $kk => $vv){
            if(isset($vv['value_menu']) && $vv['value_menu']){
                $valueMenu = App::database()->model("system_menu")->where(['id' => $vv['value_menu']])->field('table_names,pk,name')->find();
                if($valueMenu && !in_array($vv['input_type'], $outType)){
                    $table = explode(',', $valueMenu['table_names'])[0];
                    if($table && $valueMenu['name'] && $valueMenu['pk']){
                        $include[$kk]['value'] = $include[$kk]['value'] + App::database()->model($table)->column($valueMenu['name'], $valueMenu['pk']);
                    }
                }
            }
            $infield = $vv['in_field'] ?? false;
            if($infield == false) unset($include[$kk]);
        }
        return $include;
    }

    public function rendertable(Request &$request){
        $this->menuData['width'] = $this->width;
        $this->menuData['height'] = $this->height;
        $this->menuData['even'] = $this->even;
        $this->menuData['css'] = $this->css;
        $this->menuData['limit'] = min($this->limits);
        $this->menuData['limits'] = $this->limits;
        $this->menuData['lineStyle'] = $this->lineStyle;
        $this->menuData['cellMinWidth'] = $this->cellMinWidth;
        $this->menuData['head_toolbar'] = $this->headToolbar;
        $this->menuData['row_toolbar'] = $this->rowToolbar;
        $this->menuData['searchpage'] = './table/search.html';
        $this->menuData['skin'] = $this->skin;
        $this->menuData['size'] = $this->size;
        $this->menuData['cols'] = $this->getCols($this->menuData['table_names'][0]);//Menu::getMainDbSchma($this->menuData)['schma'];
        $this->menuData['data'] = $this->data;
        $this->menuData['tabs'] = $this->tabs;
        return $this->menuData;
    }

    /**
     * 通用获取数据
     * @param int $page
     * @param int $limit
     * @param array $search
     * @return array
     * @throws \Exception
     */
    protected function data(int $page, int $limit, array $search){
        if(isset($this->menuData['table_names'][0]) == false) App::error()->setError($this->menuData['id'].'的table_names未配置');
        $model = App::database()->model($this->menuData['table_names'][0]);
        foreach($search as $v){
            if($v == false || isset($v[0]) == false || isset($v[1]) == false|| isset($v[2]) == false) continue;
            switch ($v[1]){
                case "=":
                    $model->whereRaw($v[0]." = '".addslashes($v[2])."'");
                    break;
                case ">=":
                    $model->whereRaw($v[0]." >= '".addslashes($v[2])."'");
                    break;
                case "<=":
                    $model->whereRaw($v[0]." <= '".addslashes($v[2])."'");
                    break;
                case "!=":
                    $model->whereRaw($v[0]." != '".addslashes($v[2])."'");
                    break;
                case "between":
                    $vals = explode(',', $v[2]);
                    $model->whereRaw($v[0]." BETWEEN '".addslashes(($vals[0] ?? "0"))."' AND '".addslashes(($vals[1] ?? "0"))."'");
                    break;
                default:
                    $model->whereRaw($v[0]." LIKE '%".addslashes($v[2])."%'");
            }
        }
        return $model->order($this->menuData['pk'].' desc')->finder((int)$page, (int)$limit);
    }

    /**
     * 获取列表数据
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function gettable(Request &$request){
        $page = $request->post('page', '1');
        $limit = $request->post('limit', '20');
        $search = $request->post('search', []);
        return $this->data((int)$page, (int)$limit, $search);
    }

    public function addfromtable(Request &$request){
        $data = [];
        $schemaDir = App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR;
        foreach($this->menuData['table_names'] as $v){
            $include = $this->getCols($v);
            //$include = include $schemaDir.$v.'.php';
            unset($include[$this->menuData['pk']], $include['create_time'], $include['update_time'], $include['delete_time']);

            $data[] = [
                'title' => $this->getTableComment($v),
                'table_name' => $v,
                'schema' => $include
            ];
        }
        return $data;
    }

    public function editfromtable(Request &$request){
        $input = App::validate()->check($request->get(), [
            'pk' => 'Required',
        ]);
        $data = [];
        foreach($this->menuData['table_names'] as $v){
            $include = $this->getCols($v);
            unset($include[$this->menuData['pk']], $include['create_time'], $include['update_time'], $include['delete_time']);
            $row = App::database()->model($v)->where([$this->menuData['pk'] => $input['pk']])->find();
            foreach ($include as $field => $val){
                if(isset($row[$field])){
                    if(in_array($val['input_type'], ['checkbox']) && $row[$field]){
                        $include[$field]['default'] = json_decode($row[$field], true);
                    }else{
                        $include[$field]['default'] = $row[$field];
                    }
                }
            }
            $data[] = [
                'title' => $this->getTableComment($v),
                'table_name' => $v,
                'schema' => $include
            ];
        }
        return $data;
    }

    /**
     * 添加
     * @param Request $request
     * @return void
     */
    public function posttable(Request &$request){
        $post = $request->post();
        App::database()->transaction(function(mixed $pdo) use ($post){
            $schemaDir = App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR;
            $pk = 0;
            foreach ($post as $k => $v){
                if(!in_array($k, $this->menuData['table_names'])) App::error()->setError($k.'不在table_names配置中', 403);
                if($pk) $v[$this->menuData['pk']] = $pk;
                $include = include $schemaDir.$k.'.php';
                if(isset($include['create_time'])) $v['create_time'] = time();
                if(isset($include['update_time'])) $v['update_time'] = time();
                foreach($v as $kk => $vv){
                    if(is_array($vv)) $v[$kk] = json_encode($vv, JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE);
                }
                $getId = App::database()->model($k)->insertGetId($v, $pdo);
                if($pk == false) $pk = $getId;
            }
        });
        return [];
    }

    /**
     * 更新
     * @param Request $request
     * @return void
     */
    public function puttable(Request &$request){
        $input = App::validate()->check($request->get(), [
            'pk' => 'Required',
        ]);
        $post = $request->post();
        App::database()->transaction(function(mixed $pdo) use ($post, $input){
            $schemaDir = App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR;
            $pk = 0;
            foreach ($post as $k => $v){
                if(!in_array($k, $this->menuData['table_names'])) App::error()->setError($k.'不在table_names配置中', 403);
                $include = include $schemaDir.$k.'.php';
                if(isset($include['update_time'])) $include['update_time'] = time();
                foreach($v as $kk => $vv){
                    if(is_array($vv)) $v[$kk] = json_encode($vv, JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE);
                }
                $getId = App::database()->model($k)->where([$this->menuData['pk'] => $input['pk']])->update($v, $pdo);
            }
        });
        // 再触发一下查询接口
        return $this->data(1, 1, [[$this->menuData['pk'], '=', $input['pk']]]);
    }

    public function putconfig(Request &$request){
        $post = $request->post('system_config');
        $vars = App::database()->model("system_config")->whereIn('varname', array_keys($post))->column('sortrank', 'varname');
        $insertData = [];
        foreach($vars as $k => $v){
            if(isset($post[$k])){
                // 更新
                App::database()->model("system_config")->where(['varname' => $k])->update(['value' => $post[$k]]);
                unset($post[$k]);
            }
        }

        foreach($post as $k => $v){
            $insertData[] = [
                'varname' => $k,
                'title' => $k,
                'value' => $v,
            ];
        }
        if($insertData) App::database()->model("system_config")->insertAll($insertData);
        return [];
    }

    public function deletetable(Request &$request){
        $input = App::validate()->check($request->post(), [
            'pk' => 'Required',
        ]);
        App::database()->transaction(function(mixed $pdo) use ($input){
            foreach($this->menuData['table_names'] as $v){
                App::database()->model($v)->whereIn($this->menuData['pk'], $input['pk'])->delete($pdo);
            }
        });
        return [];
    }

    public function searchfromtable(Request &$request){
        $data = [];
        $schemaDir = App::rootPath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'schema'.DIRECTORY_SEPARATOR;
        foreach($this->menuData['table_names'] as $v){
            $include = $this->getCols($v);
            unset($include[$this->menuData['pk']]);
            $data = $include;
            break;
        }
        return $data;
    }

    /**
     * 获取表注释
     * @param string $dbName
     * @return string
     */
    protected function getTableComment(string $dbName){
        $data = App::database()->model($dbName)->query('show create table '.$dbName);
        if(isset($data[0]['Create Table'])){
            $arr = explode("COMMENT='", $data[0]['Create Table']);
            if(isset($arr[1])) return rtrim($arr[1], "'");
        }
        return $dbName;
    }

    public function xmselecttable(Request &$request){
        $input = App::validate()->check($request->get(), [
            'value_menu' => 'Required',
        ]);
        $menuData = App::database()->model('system_menu')->where(['id' => $input['value_menu']])->find();
        if($menuData == false) App::error()->setError($input['value_menu'].'的菜单信息不存在', 404);
        $menuData['table_names'] = explode(',', $menuData['table_names']);
        $tableName = $menuData['table_names'][0] ?? App::error()->setError($menuData['id'].'的table_names未指定', 404);
        if($menuData['pk'] == false || $menuData['name'] == false) App::error()->setError($menuData['id'].'的pk,name未完善', 404);
        $model = App::database()->model($tableName);
        if($keyword = $request->post('keyword')){
            $model = $model->whereRaw($menuData['name']. ' LIKE '. '%'.addslashes($keyword).'%');
        }
        $data = $model->field($menuData['pk'].' as id,'.$menuData['name'].' as title')->order($menuData['pk'].' desc')->finder(1, 20);
        return $data;
    }

    protected $cascaders = [];
    /**
     * 联动数据
     * @apiParam {String} Required id 菜单id
     * @return array
     */
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
        $data = App::database()->model($tableName)->field($menuData['pk'].' as value,'.$menuData['name'].' as label,'.$menuData['pid'].' as pid')->select();

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

    /**
     * 获取改变子联动数据
     * @param $cascader
     * @param $data
     * @param int $parentId
     */
    protected function getChildCascader(&$cascader, $data, $parentId = 0){
        foreach($data as $k => $v){
            if($parentId == $v['pid']){
                $id = $v['value'];
                unset($data[$k], $v['pid']);
                $cascader['children'][$id] = $v;
                $this->getChildCascader($cascader['children'][$id], $data, $id);
                $cascader['children'] = array_values($cascader['children']);//没有问题
            }
        }
    }

    protected function getInputFrom(string $field, string $title, string $inputType = 'text', bool $required = false, int $maxlength = 255, mixed $option = []){
        return [
            'field' => $field,
            'null' => $required ? 'no' : '',
            'default' => App::database()->model("system_config")->where(['varname' => $field])->value("value"),
            'title' => $title,
            'value' => is_array($option) ? $option : [],
            'value_menu' => is_string($option) ? $option : "",
            'input_type' => $inputType,
            'input_maxlength' => $maxlength,
        ];
    }

}