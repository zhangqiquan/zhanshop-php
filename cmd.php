<?php
declare (strict_types=1);

use zhanshop\App;

require __DIR__ . '/vendor/autoload.php';

$console = App::make(__DIR__)->console();

// 运行控制台层逻辑
$output = $console->run($argv);

// 程序结束
$console->end($output);