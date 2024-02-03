<?php
// +----------------------------------------------------------------------
// | zhanshop_admin / auto.php [ 2023/4/21 下午9:03 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

define("BASE_PATH", dirname(dirname(dirname(dirname(__FILE__)))));

require BASE_PATH . '/vendor/autoload.php';

define("TEST_PATH", dirname(dirname(dirname(__FILE__))));

spl_autoload_register(function ($class) {
    $classFile = TEST_PATH .DIRECTORY_SEPARATOR. str_replace('\\', '/', $class) . '.php';
    if (file_exists($classFile)) {
        require_once ($classFile);
    }

    $classFile = \zhanshop\App::rootPath().DIRECTORY_SEPARATOR.'proto' .DIRECTORY_SEPARATOR. str_replace('\\', '/', $class) . '.php';
    if (file_exists($classFile)) {
        require_once ($classFile);
    }

});