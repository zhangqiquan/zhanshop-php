<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / base_conf.php    [ 2023/3/5 14:02 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\service\finder;

use zhanshop\Request;

class base_conf extends basefinder
{
    public function editfromconfig(Request &$request)
    {
        $data = [
            [
                'title' => '用户协议',
                'table_name' => '123',
                'schema' => [
                    $this->getInputFrom('app_user_agreement', '用户协议', 'baidueditor', true),
                ],
            ],
            [
                'title' => '隐私政策',
                'table_name' => '123',
                'schema' => [
                    $this->getInputFrom('app_privacy_policy', '隐私政策', 'baidueditor', true),
                ],
            ]
        ];
        return $data;
    }
}