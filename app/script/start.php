<?php
// +----------------------------------------------------------------------
// | zhanshop-device / start.php    [ 2024/1/20 下午10:34 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2024 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);
use zhanshop\App;

require __DIR__ . '/../../vendor/autoload.php';
(new App(dirname(__DIR__, 2)));
App::config();

$includeFile = __DIR__.'/'.$argv[1].'.php';
if(!file_exists($includeFile)) App::error()->setError($includeFile.'脚本文件不存在');
include $includeFile;

$class = '\\app\\script\\'.str_replace("/", "\\", $argv[1]);
unset($argv[0], $argv[1]);
$_SERVER['argv'] = array_values($argv);
(new $class())->execute();

