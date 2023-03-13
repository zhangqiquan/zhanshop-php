<?php
// +----------------------------------------------------------------------
// | UserService【系统生成】   [ 2023-03-09 09:34:22 ]
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
     * 用户信息 GET
     * @return array
     */
    public function getInfo(mixed &$request){
        $data = [
            'user_id' => 1,
            'nick' => '张启全',
            'avatar' => 'https://thirdwx.qlogo.cn/mmopen/vi_32/zzhk6EeEYIOU7icasmdnqXiboybTkESvzJnrsVWVY66YJgAQlshunMwOkw9Cg5jjZp3b5ImS89Sz2PWK1FDphfNg/132',
        ];
        return $data;
    }
	/**
     * 用户信息 POST
     * @apiParam {String} Optional avatar 头像
     * @apiParam {String} Optional nick 昵称
     * @return array
     */
    public function postInfo(mixed &$request){
        $data = [];
        return $data;
    }
	/**
     * 用户信息 PUT
     * @return array
     */
    public function putInfo(mixed &$request){
        $data = [];
        return $data;
    }
	/**
     * 用户信息 DELETE
     * @return array
     */
    public function deleteInfo(mixed &$request){
        $data = [];
        return $data;
    }
}