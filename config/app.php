<?php
// +----------------------------------------------------------------------
// | 应用设置1
// +----------------------------------------------------------------------
use zhanshop\App;

return [
    // App调式模式
    'app_debug'     => App::env()->get('APP_DEBUG', false),
    // APP公钥
    'app_key'       => App::env()->get('APP_KEY', 'zhanshop'),
    // APP版本 版本参数发生变化server将会重启
    'app_version'   => 'v1.0.4',
    // 显示错误信息
    'show_error'    => (bool)App::env()->get('SHOW_ERROR', false),
    // 序号用于集群服务的序号标识符号
    'serial_code'   => (int)App::env()->get('SERIAL_CODE', '0'),
    // 错误显示信息,非调试模式有效
    'error_message' => '系统错误！请稍后再试～',

];
