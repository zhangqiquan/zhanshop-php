<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / system_role.php    [ 2023/2/28 14:59 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\service\finder;

use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

class SysRole extends BaseFinder
{
    public $headToolbar = [
        [
            'event' => 'add',
            'ico' => '&#xe608;',
            'title' => '添加',
            'method' => "",
            'page' => "./role/add.html",
        ],
        [
            'event' => 'deletes',
            'ico' => '&#xe640;',
            'title' => '删除',
            'method' => "",
            'page' => "",
        ]
    ];

    public $rowToolbar = [
        [
            'event' => 'edit',
            'ico' => '&#xe642;',
            'title' => '编辑',
            'method' => '',
            'page' => './role/edit.html',
        ],
        [
            'event' => 'delete',
            'ico' => '&#xe640;',
            'title' => '删除',
            'method' => '',
            'page' => '',
        ]
    ];

    public function addfromtable(Request &$request, Response &$response){
        $data = parent::addfromtable($request);
        $data[0]['schema']['menus']['value'] = App::database()->model('system_menu')->get();
        return $data;
    }

    public function editfromtable(Request &$request, Response &$response){
        $data = parent::editfromtable($request);
        $data[0]['schema']['menus']['value'] = App::database()->model('system_menu')->get();
        return $data;
    }
}