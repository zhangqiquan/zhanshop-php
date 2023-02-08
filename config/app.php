<?php
// +----------------------------------------------------------------------
// | 应用设置
// +----------------------------------------------------------------------
use zhanshop\App;

return [
    // App调式模式
    'app_debug'        => App::env()->get('APP_DEBUG', false),
    // APP公钥
    'app_key'          => App::env()->get('APP_KEY', 'zhanshop'),
    // 错误显示信息,非调试模式有效
    'error_message'    => '系统错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'   => false,
];
