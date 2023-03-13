<?php
// +----------------------------------------------------------------------
// | flow-course / index.php    [ 2021/10/31 8:48 上午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use kernel\App;
use kernel\service\ApiDocService;

// 执行HTTP响应
$http = (new App(dirname(__DIR__, 2)))->http();
// 运行apiDoc层逻辑
$response = ApiDocService::run();
// 发送响应
$response->send();
// 结束响应
$http->end($response);