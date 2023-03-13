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

App::route()->match(['GET','POST'], '/apidoc', 'Index@apidoc');
App::route()->match(['GET'], '/hello', 'Index@hello');
App::route()->match(['POST'], '/passport.login', 'Passport@login');
App::route()->match(['GET','POST','PUT','DELETE'], '/user.info', 'User@info');
