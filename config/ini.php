<?php
// +----------------------------------------------------------------------
// | flow-course / ini.php    [ 2021/10/29 9:46 上午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

use zhanshop\App;

return [
    // 默认时区
    'date.timezone'            => App::env()->get('INI_TIMEZONE', 'Asia/Shanghai'),
    // 内存限制
    'memory_limit'             => App::env()->get('INI_MEMORY_LIMIT', '2048M'),
    // 显示错误
    'display_errors'           => 'On',
    // 显示错误步骤
    'display_startup_errors'   => 'On',
    'max_execution_time'       => 0,
];