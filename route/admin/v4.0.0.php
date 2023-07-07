<?php
// +----------------------------------------------------------------------
// | 路由文件【系统生成】   [ 2023-02-04 19:46:14 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

use zhanshop\App;
use app\api\admin\v4_0_0\middleware\Test;
use app\api\admin\v4_0_0\controller\Passport;
use app\api\admin\v4_0_0\middleware\Authenticate;
use app\api\admin\v4_0_0\controller\Index;

App::route()->group('/index', function (){
    App::route()->match(['GET'], '.ping', [Index::class, 'ping'])->extra(['id', 'cid'])->middleware([Test::class]);
    App::route()->match(['GET'], '.main', [Index::class, 'main']);
    App::route()->match(['GET','POST', 'PUT'], '.config', [Index::class, 'config']);
    App::route()->match(['GET','POST', 'PUT', 'DELETE'], '.index', [Index::class, 'index']);
    App::route()->match(['GET','POST', 'PUT', 'DELETE'], '.table', [Index::class, 'table']);
    App::route()->match(['GET','POST', 'PUT', 'DELETE'], '.user', [Index::class, 'user']);
})->middleware([
    \app\api\admin\v4_0_0\middleware\Authenticate::class
]);


App::route()->match(['POST'], '/passport.login', [Passport::class, 'login']);

App::route()->match(['GET','POST'], '/index.plugin', [Index::class, 'plugin'])->extra(['plugin']);



