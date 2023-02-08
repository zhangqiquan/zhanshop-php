<?php
// +----------------------------------------------------------------------
// | flow-course / Controller.php    [ 2021/10/25 3:55 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace app\wss;

use zhanshop\App;

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
    protected $afterMiddleware = [];

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

    public function _onMessage(mixed &$request){
        return "收到";
    }
}