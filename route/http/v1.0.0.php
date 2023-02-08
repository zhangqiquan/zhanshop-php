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

App::route()->match(['GET','POST','PUT','DELETE'], '/', 'Index@index');
App::route()->match(['GET'], '/apiDoc.apis', 'ApiDoc@apis');
App::route()->match(['POST'], '/apiDoc.debug', 'ApiDoc@debug');
App::route()->match(['GET','POST'], '/apiDoc.detail', 'ApiDoc@detail');
App::route()->match(['POST'], '/apiDoc.login', 'ApiDoc@login');
App::route()->match(['POST','DELETE'], '/user.login', 'User@login');
