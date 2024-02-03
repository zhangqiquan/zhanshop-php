<?php
// +----------------------------------------------------------------------
// | flow-course / Controller.php    [ 2021/10/25 3:55 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace app\api\admin;

use app\api\admin\v1\service\IndexService;
use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

class Controller
{
    /**
     * finder
     * @param Request $request
     * @return mixed
     */
    protected function finder(Request &$request, Response &$response){
        $menuId = $request->getData('id');
        $service = App::make(IndexService::class);
        $action = $request->method();
        $service->permission((int)$request->getData('user.role_id'), (string)$menuId); // 验证菜单权限
        $result = $service->getFinder((string)$menuId)->$action($request, $response);
        return $result;
    }

    public function result(mixed &$data = [], $msg = 'OK', $code = 0){
        return [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
    }
}