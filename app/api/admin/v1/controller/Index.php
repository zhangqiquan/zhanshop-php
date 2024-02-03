<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Index.php    [ 2023/2/27 9:02 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\controller;

use app\api\admin\Controller;
use app\api\admin\v1\middleware\Authenticate;
use app\api\admin\v1\service\IndexService;
use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

class Index extends Controller
{
    /**
     * @api GET index 后台菜单
     * @apiGroup 后台管理
     * @apiMiddleware AdminAuth::class
     */
    public function getIndex(Request &$request, Response &$response){
        $result = App::make(IndexService::class)->getIndex((int)$request->getData('user.user_id'), (int)$request->getData('user.role_id'));
        return $this->result($result);
    }
    /**
     * @api GET main 后台主页
     * @apiGroup 后台管理
     * @apiMiddleware AdminAuth::class
     */
    public function getMain(Request &$request, Response &$response){
        $result = App::make(IndexService::class)->getMain();
        return $this->result($result);
    }

    /**
     * @api GET user 用户信息
     * @apiGroup 后台管理
     * @apiMiddleware AdminAuth::class
     */
    public function getUser(Request &$request, Response &$response){
        $result = App::make(IndexService::class)->getUser((int)$request->getData('user.user_id'));
        return $this->result($result);
    }
    /**
     * @api POST user 更新用户信息
     * @apiGroup 后台管理
     * @apiMiddleware AdminAuth::class
     */
    public function postUser(Request &$request, Response &$response){
        $result = App::make(IndexService::class)->postUser((int)$request->getData('user.user_id'), $request->post());
        return $this->result($result);
    }

    /**
     * @api GET config/{id} 获取配置
     * @apiGroup 后台管理
     * @apiMiddleware AdminAuth::class
     */
    public function getConfig(Request &$request, Response &$response){
        $result = $this->finder($request, $response);
        return $this->result($result);
    }

    /**
     * @api POST config/{id} 更新配置
     * @apiGroup 后台管理
     * @apiMiddleware AdminAuth::class
     */
    public function postConfig(Request &$request, Response &$response){
        $result = $this->finder($request, $response);
        return $this->result($result);
    }

    /**
     * @api GET table/{id} 获取表格数据
     * @apiGroup 后台管理
     * @apiMiddleware AdminAuth::class
     */
    public function getTable(Request &$request, Response &$response){
        $result = $this->finder($request, $response);
        return $this->result($result);
    }

    /**
     * @api POST table/{id} 更新表格数据
     * @apiGroup 后台管理
     * @apiMiddleware AdminAuth::class
     */
    public function postTable(Request &$request, Response &$response){
        $result = $this->finder($request, $response);
        return $this->result($result);
    }

    /**
     * @api GET ping ping操作
     * @apiGroup 后台管理
     * @apiMiddleware AdminAuth::class
     */
    public function getPing(Request &$request, Response &$response){}
}