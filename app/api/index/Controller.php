<?php
// +----------------------------------------------------------------------
// | flow-course / Controller.php    [ 2021/10/25 3:55 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace app\api\index;

use app\api\admin\v4_0_0\middleware\RequestLog;
use zhanshop\App;
use zhanshop\Request;

class Controller
{
    public const RESP_CODE = 'code';
    public const RESP_MSG = 'msg';
    public const RESP_DATA = 'data';


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