<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / IndexService.php    [ 2023/8/11 11:42 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service;

use app\helper\Password;
use zhanshop\App;

class IndexService extends BaseService
{
    /**
     * 获取后台菜单
     * @param int $userId
     * @param int $roleId
     * @return array
     * @throws \Exception
     */
    public function getIndex(int $userId, int $roleId){
        $data = App::database()->model('system_menu')->get($roleId);
        // 每次刷新首页都会刷新权限菜单的缓存
        if($data){
            $menuIds = array_column($data, 'id');
            $this->setRoleMenu($roleId, $menuIds);
        }
        $user = App::database()->model("system_user")->where(['user_id' => $userId, 'enabled' => '1'])->field('user_id,user_name,avatar')->find();
        if($user == false) App::error()->setError('用户不存在或被禁用', 10001);
        return ['menu' => $data, 'user' => $user];
    }

    /**
     * 后台首页统计假数据
     * @param int $userId
     * @param int $roleId
     * @return array
     */
    public function getMain(){
        return [
            'today_payment' => date('njHi'),
            'user_number' => '9'.date('Ynj', strtotime('-99day')),
            'yesterday_payment' => '7'.date('njY', strtotime('-1day')),
            'yesterday_pv' => '835'.date('nYj', strtotime('-10day'))
        ];
    }

    /**
     * 获取当前用户信息
     * @return array
     */
    public function getUser(int $userId){
        return App::database()->model("system_user")->where(['user_id' => $userId])->find();
    }

    /**
     * 更新当前用户信息
     * @param int $userId
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function postUser(int $userId, array $data){
        $userName = App::database()->model("system_user")->where(['user_id' => $userId])->value("user_name");
        if($userName == false) App::error()->setError('没有相关用户信息', 404);
        App::database()->model("system_user")->where(['user_id' => $userId])->update(
            [
                'avatar' => $data['avatar'],
                'password' => Password::hashEncode($data['password'], $userName),
            ]
        );
        return [];
    }

    public function postTable(int $roleId, string $menuId, string $action){
        $this->permission($roleId, $menuId); // 菜单权限验证
        $this->getFinder($menuId)->$action();
    }
}