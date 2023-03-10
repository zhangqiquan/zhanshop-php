<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / system_user.php    [ 2023/3/6 10:17 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\service\finder;

use app\admin\v3_0_0\service\plugin\Password;
use zhanshop\App;
use zhanshop\Request;

class sys_user extends basefinder
{
    protected $headToolbar = [
        [
            'event' => 'add',
            'ico' => '&#xe608;',
            'title' => '添加',
            'method' => '',
            'page' => './table/add.html',
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
    ];

    /**
     * 添加
     * @param Request $request
     * @return void
     */
    public function posttable(Request &$request){
        $post = $request->post('system_user');
        try {
            $post['password'] = Password::hashEncode($post['password'], $post['user_name']);
            $post['create_time'] = time();
            App::database()->model('system_user')->insert($post);
        }catch (\Throwable $e){
            App::error()->setError($e->getMessage());
        }
        return [];
    }

    public function puttable(Request &$request)
    {
        $input = App::validate()->check($request->get(), [
            'pk' => 'Required',
        ]);
        $post = $request->post('system_user');
        try {
            $post['password'] = Password::hashEncode($post['password'], $post['user_name']);
            App::database()->model('system_user')->where(['user_id' => $input['pk']])->update($post);
        }catch (\Throwable $e){
            App::error()->setError($e->getMessage());
        }
        return $this->data(1, 1, [[$this->menuData['pk'], '=', $input['pk']]]);
    }
}