<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / IndexService.php    [ 2023/2/27 9:05 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\index\v1_0_0\service;

use zhanshop\apidoc\ApiDoc;
use zhanshop\apidoc\Sqlite;
use zhanshop\apidoc\SwaggerDoc;
use zhanshop\App;
use zhanshop\Error;

class IndexService
{
    /**
     * 获取apidoc
     * @return void
     */
    public function getApidoc(string $url){
        $data = [
            'menu' => [],
            'user' => [
                "user_id" => 1,
                "user_name" => "admin",
                "avatar" =>"http://test-cdn.zhanshop.cn/202332/1677734290588165342.jpg"
            ]
        ];
        if($url != 'local'){
            if($url == false && strpos($url, 'http') !== 0) App::error()->setError('请输入一个swagger JSON格式的url', Error::FORBIDDEN);
            $data['menu'] = App::make(SwaggerDoc::class)->getApidoc($url);
        }else{
            $data['menu'] = App::make(ApiDoc::class)->getApidoc();
        }
        return $data;
    }

    /**
     * 获取apidoc详情
     * @param $version
     * @param $uri
     * @return void
     */
    public function apiDocDetail($version, $uri){
        return [];
    }
}