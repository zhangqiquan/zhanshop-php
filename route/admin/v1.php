<?php
// +----------------------------------------------------------------------
// | admin/v1【系统生成】   [ 2024-02-03 20:30:17 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2024 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

use zhanshop\App;

App::route()->group("/index", function (){
      App::route()->rule("GET", "index", [\app\api\admin\v1\controller\Index::class, "getIndex"]);
      App::route()->rule("GET", "main", [\app\api\admin\v1\controller\Index::class, "getMain"]);
      App::route()->rule("GET", "user", [\app\api\admin\v1\controller\Index::class, "getUser"]);
      App::route()->rule("POST", "user", [\app\api\admin\v1\controller\Index::class, "postUser"]);
      App::route()->rule("GET", "config", [\app\api\admin\v1\controller\Index::class, "getConfig"])->extra(["id"]);
      App::route()->rule("POST", "config", [\app\api\admin\v1\controller\Index::class, "postConfig"])->extra(["id"]);
      App::route()->rule("GET", "table", [\app\api\admin\v1\controller\Index::class, "getTable"])->extra(["id"]);
      App::route()->rule("POST", "table", [\app\api\admin\v1\controller\Index::class, "postTable"])->extra(["id"]);
      App::route()->rule("GET", "ping", [\app\api\admin\v1\controller\Index::class, "getPing"]);
})->middleware([\app\middleware\AdminAuth::class]);

App::route()->group("/passport", function (){
      App::route()->rule("POST", "login", [\app\api\admin\v1\controller\Passport::class, "postLogin"]);
      App::route()->rule("GET", "test", [\app\api\admin\v1\controller\Passport::class, "getTest"]);
});

