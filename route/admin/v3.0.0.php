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

App::route()->match(['GET'], '/index.ping', 'Index@ping');

App::route()->match(['GET'], '/index.main', 'Index@main');

App::route()->match(['GET','POST', 'PUT'], '/index.config', 'Index@config');

App::route()->match(['POST'], '/passport.login', 'Passport@login');

App::route()->match(['GET','POST', 'PUT', 'DELETE'], '/index.index', 'Index@index');

App::route()->match(['GET','POST', 'PUT', 'DELETE'], '/index.table', 'Index@table');

App::route()->match(['GET','POST', 'PUT', 'DELETE'], '/index.user', 'Index@user');
