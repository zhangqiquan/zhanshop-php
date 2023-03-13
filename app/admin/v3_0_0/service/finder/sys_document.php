<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / sys_document.php    [ 2023/2/28 19:15 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\service\finder;

use app\admin\v3_0_0\service\plugin\Storagetoken;
use zhanshop\App;
use zhanshop\Request;

class sys_document extends basefinder
{
    public $headToolbar = [
        [
            'event' => 'add',
            'ico' => '&#xe608;',
            'title' => '添加',
            'method' => "",
            'page' => "./dialog/upload-file.html",
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
            'event' => 'delete',
            'ico' => '&#xe640;',
            'title' => '删除',
            'method' => '',
            'page' => '',
        ]
    ];

    public function uploadtokentable(Request &$request){
        $input = App::validate()->check($request->post(), [
            'factory' => 'Required',
            'type' => 'Required'
        ]);
        $factory = $input['factory'];
        return Storagetoken::$factory($input['type']);
    }
    public function posttable(Request &$request){
        $post = $request->post('system_files');
        foreach ($post as $k => $v){
            $post[$k]['create_time'] = time();
        }
        App::database()->model('system_files')->insertAll($post);
        return [];
    }
}