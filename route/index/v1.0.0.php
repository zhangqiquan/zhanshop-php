<?php
// +----------------------------------------------------------------------
// | 路由文件【系统生成】   [ 2023-03-09 09:34:22 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

use zhanshop\App;

use app\api\index\v1_0_0\controller\Index;
use app\api\index\v1_0_0\controller\Passport;
use app\api\index\v1_0_0\controller\User;

App::route()->match(['GET','POST'], '/apidoc', [Index::class, 'apidoc']);
App::route()->match(['GET'], '/hello', [Index::class, 'hello']);
App::route()->match(['POST'], '/passport.login', [Passport::class, 'login']);
App::route()->match(['GET','POST','PUT','DELETE'], '/user.info', [User::class, 'info']);