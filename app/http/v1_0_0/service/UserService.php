<?php
// +----------------------------------------------------------------------
// | UserService【系统生成】   [ 2023-02-04 19:46:14 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace app\http\v1_0_0\service;

use zhanshop\App;

class UserService
{

    /**
     * 用户登录
     * @apiParam {String} Required code 手机号获取凭证,详见微信文档https://developers.weixin.qq.com/miniprogram/dev/framework/open-ability/getPhoneNumber.html
     * @apiParam {String} Optional share_uid 分享邀请注册的用户id
     * @apiParam {String} Optional encryptedData 微信参数
     * @apiParam {String} Optional iv 微信参数
     * @apiExplain {json} {"10001":"验证码错误"}
     * @return array
     */
    public function postLogin(mixed &$request){
        return [
            'user_name' => "mobile/13884846177",
            'nick' => "Test123",
            'avatar' => 'https://fanyi-cdn.cdn.bcebos.com/static/translation/img/header/logo_e835568.png',
            'user_id' => "1",
            'token' => "x1Xn7YBaFQSR+KNSo1LeTgID1kRMT9m5vUPi4G+/56iD19eCKsMXk2pJyXYJNgdvU="
        ];
    }
	/**
     * 登陆
     * @return array
     */
    public function deleteLogin(mixed &$request){
        $data = App::database()->model("user_info")->select(); // 数据模型测试代码
        return $data;
    }
}