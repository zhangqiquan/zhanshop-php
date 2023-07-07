<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / IndexService.php    [ 2023/2/27 9:05 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\service;

use app\admin\v4_0_0\middleware\Authenticate;
use app\helper\Password;
use zhanshop\App;
use zhanshop\Error;
use zhanshop\Request;
use zhanshop\Response;

class IndexService extends BaseService
{
    public function getmain(Request &$request, Response &$response){
        return [
            'today_payment' => date('njHi'),
            'user_number' => '9'.date('Ynj', strtotime('-99day')),
            'yesterday_payment' => '7'.date('njY', strtotime('-1day')),
            'yesterday_pv' => '835'.date('nYj', strtotime('-10day'))
        ];
    }

    public function getuser(Request &$request, Response &$response){
        return App::database()->model("system_user")->where(['user_id' => $request->getData('user.user_id')])->find();
    }

    public function postuser(Request &$request, Response &$response){
        $userName = App::database()->model("system_user")->where(['user_id' => $request->getData('user.user_id')])->value("user_name");
        if($userName == false) App::error()->setError('没有相关用户信息', 404);
        App::database()->model("system_user")->where(['user_id' => $request->getData('user.user_id')])->update(
            [
                'avatar' => $request->post('avatar'),
                'password' => Password::hashEncode($request->post('password'), $userName),
            ]
        );
        return [];
    }

    // 修改了权限 需要退出，如果只是在当前角色上添加或者修改了菜单只要刷新即可,如果强制一个用户下线
    public function getindex(Request &$request, Response &$response){
        $userId = $request->getData('user.user_id');
        $roleId = $request->getData('user.role_id');
        $roleId = ($roleId == false) ? 0 : intval($roleId);
        $data = App::database()->model('system_menu')->get($roleId);
        // 每次刷新首页都会刷新权限菜单的缓存
        if($data){
            $menuIds = array_column($data, 'id');
            $this->setRoleMenu((int)$request->getData('user.role_id', 0), $menuIds);
        }
        $user = App::database()->model("system_user")->where(['user_id' => $userId, 'enabled' => '1'])->field('user_id,user_name,avatar')->find();
        if($user == false) App::error()->setError('用户不存在或被禁用', 10001);
        return ['menu' => $data, 'user' => $user];
    }

    /**
     * 获取插件
     * @param Request $request
     * @return void
     */
    public function getPlugin(Request &$request, Response &$response){
        $plugin = ucfirst((string)$request->getData('plugin', ''));
        try {
            return App::make('\\app\\api\\admin\\v4_0_0\\service\\plugin\\'.$plugin)->data($request->get());
        }catch (\Throwable $e){
            App::error()->setError($e->getMessage(), 417);
        }
    }

    public function postPlugin(Request &$request, Response &$response){
        $plugin = ucfirst((string)$request->getData('plugin', ''));
        try {
            $data = App::make('\\app\\api\\admin\\v4_0_0\\service\\plugin\\'.$plugin)->data($request->post());
            return $data;
        }catch (\Throwable $e){
            App::error()->setError($e->getMessage(), 417);
        }
    }
}