<?php
// +----------------------------------------------------------------------
// | admin/v1【系统生成】   [ 2024-01-31 15:30:02 ]
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

App::route()->group("/proxy", function (){
      App::route()->rule("TCP", "socks5Message", [\app\api\admin\v1\controller\Proxy::class, "socks5Message"])->extra(["tofd"]);
      App::route()->rule("TCP", "socks5Close", [\app\api\admin\v1\controller\Proxy::class, "socks5Close"])->extra(["tofd"]);
      App::route()->rule("TCP", "httpMessage", [\app\api\admin\v1\controller\Proxy::class, "httpMessage"])->extra(["tofd"]);
      App::route()->rule("TCP", "httpClose", [\app\api\admin\v1\controller\Proxy::class, "httpClose"])->extra(["tofd"]);
});

App::route()->group("/ssh", function (){
      App::route()->rule("TCP", "open", [\app\api\admin\v1\controller\Ssh::class, "open"])->extra(["tofd"]);
});

