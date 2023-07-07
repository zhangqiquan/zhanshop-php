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

use app\api\admin\v4_0_0\middleware\RequestLog;
use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

class Controller
{
    public const RESP_CODE = 'code';
    public const RESP_MSG = 'msg';
    public const RESP_DATA = 'data';
    /**
     * 前置中间件
     * @var array
     */
    protected $beforeMiddleware = [];

    /**
     * 后置中间件
     * @var array
     */
    protected $afterMiddleware = [
        RequestLog::class
    ];

    /**
     * finder
     * @param Request $request
     * @return mixed
     */
    public function finder(Request &$request, Response &$response){
        $menuId = $request->get('id');
        list($obj, $action) = $request->service();
        $obj->permission((int)$request->getData('user.role_id'), $menuId);
        $data = $obj->getFinder($menuId)->$action($request, $response);
        return $data;
    }

    protected function configFrom(Request &$request, Response &$response){
        $menuId = $request->get('id');
        list($obj, $action) = $request->service();
        $obj->roleVerify((int)$request->getData('user.role_id'), $menuId);
        $data = $obj->getFinder($menuId)->configFrom($request, $response);
        return $data;
    }

    /**
     * restful
     * @param Request $request
     * @return mixed
     */
    public function restful(Request &$request, Response &$response){
        list($obj, $action) = $request->service();
        $data = $obj->$action($request, $response);
        return $data;
    }

    /**
     * 统一返回
     * @param array $data
     * @param string $msg
     * @param int $code
     * @return array
     */
    public function result(mixed &$data = [], $msg = 'OK', $code = 0){
        return [
            self::RESP_CODE => $code,
            self::RESP_MSG => $msg,
            self::RESP_DATA => $data,
        ];
    }
}