<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Index.php    [ 2023/2/27 9:02 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\index\v1_0_0\controller;

use app\api\index\Controller;
use app\task\Test;
use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;
use zhanshop\Storage;

class Index extends Controller
{
    public function hello(Request &$request, Response &$response){
        return 'hello zhanshop';
    }
    /**
     * task
     * @param Request $request
     * @return void
     */
    public function task(Request &$request){
    }
}