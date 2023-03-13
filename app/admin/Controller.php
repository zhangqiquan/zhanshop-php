<?php
// +----------------------------------------------------------------------
// | flow-course / Controller.php    [ 2021/10/25 3:55 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace app\admin;

use app\admin\v3_0_0\middleware\RequestLog;
use zhanshop\App;
use zhanshop\Request;

class Controller
{
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
    public function finder(Request &$request){
        $input = &App::validate()->check($request->get(), [
            'id' => 'Required'
        ]);
        $action = $request->method().$request->getAction();
        $request->getService()->roleVerify((int)$request->getExt('role_id'), $input['id']);
        $data = $request->getService()->getFinder($input['id'])->$action($request);
        return $data;
    }

    protected function configFrom(Request &$request){
        $input = &App::validate()->check($request->get(), [
            'id' => 'Required'
        ]);
        $action = $request->method().$request->getAction();
        $request->getService()->roleVerify((int)$request->getExt('role_id'), $input['id']);
        $data = $request->getService()->getFinder($input['id'])->configFrom($request);
        return $data;
    }

    /**
     * restful
     * @param Request $request
     * @return mixed
     */
    public function restful(Request &$request, $isMenu = true){
        $action = $request->method().$request->getAction();
        if($isMenu){
            $input = &App::validate()->check($request->get(), [
                'id' => 'Required'
            ]);
            $data = $request->getService()->init($input['id'])->$action($request);
        }else{
            $data = $request->getService()->$action($request);
        }
        return $data;
    }

    /**
     * 统一返回
     * @param array $data
     * @param string $msg
     * @param int $code
     * @return array
     */
    public function result(mixed &$data = [], $msg = '成功', $code = 0){
        return [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
    }

    /**
     * 获取前置控制中间件
     */
    public function getBeforeMiddleware(){
        return $this->beforeMiddleware;
    }

    /**
     * 获取异步控制中间件
     * @return array
     */
    public function getAfterMiddleware(){
        return $this->afterMiddleware;
    }
}