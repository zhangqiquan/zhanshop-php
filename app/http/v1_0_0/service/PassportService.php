<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / PassportService.php    [ 2023/3/7 11:08 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\http\v1_0_0\service;

use zhanshop\App;
use zhanshop\Request;

class PassportService
{
    /**
     * 用户登录
     * @apiParam {String} Required type 登录方式可选值(如mobile,wechat,wechat_miniapp,apple)
     * @apiParam {String} Required data 登录json数据,手机号码登录： {"mobile":130000000000,"code":1234}，微信小程序{"js_code":"123456"}
     * @apiExplain {json} {"403":"data数据格式不正确", "404":"不支持的登录方式"}
     * @return array
     */
    public function postlogin(Request &$request){
        $input = &App::validate()->check($request->post(), [
            'type' => 'Required',
            'data' => 'Required',
        ]);
        $type = $input['type'];
        if(!is_array($input['data'])) App::error()->setError('data数据格式不正确', 403);
        return $this->$type($input['data']);
    }

    protected function mobile(array $data){
        return ['token' => 'ashe3wejqbwfbjqwf2ueqbsjdas=='];
    }

    protected function wechat(array $data){
        return ['token' => 'ashe3wejqbwfbjqwf2ueqbsjdas=='];
    }

    protected function wechat_miniapp(array $data){
        return ['token' => 'ashe3wejqbwfbjqwf2ueqbsjdas=='];
    }

    protected function apple(array $data){
        return ['token' => 'ashe3wejqbwfbjqwf2ueqbsjdas=='];
    }

    public function __call(string $name, array $arguments){
        App::error()->setError($name.'暂不支持', 404);
    }
}