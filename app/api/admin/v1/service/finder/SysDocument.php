<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / sys_document.php    [ 2023/2/28 19:15 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\finder;

use app\api\admin\v1\service\plugin\Storagetoken;
use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

class SysDocument extends BaseFinder
{
    public $headToolbar = [
        [
            'event' => 'add',
            'ico' => '&#xe608;',
            'title' => '上传',
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

    public function uploadtoken(Request &$request, Response &$response){
        $input = $request->validateRule([
            'factory' => 'Required',
            'type' => 'Required'
        ])->getData();
        $factory = $input['factory'];
        return Storagetoken::$factory($input['type']);
    }
    public function post(Request &$request, Response &$response){
        $post = $request->post('system_files');
        foreach ($post as $k => $v){
            $post[$k]['create_time'] = time();
        }
        App::database()->model('system_files')->insertAll($post);
        return [];
    }
}