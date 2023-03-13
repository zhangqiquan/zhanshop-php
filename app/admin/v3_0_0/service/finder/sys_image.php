<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / sys_image.php    [ 2023/2/28 18:25 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\admin\v3_0_0\service\finder;

use app\admin\v3_0_0\service\plugin\Storagetoken;
use Qiniu\Auth as SdkAuth;
use zhanshop\App;
use zhanshop\Request;

class sys_image extends basefinder
{
    public function uploadtokentable(Request &$request){
        $input = App::validate()->check($request->post(), [
            'factory' => 'Required',
            'type' => 'Required'
        ]);
        $factory = $input['factory'];
        return Storagetoken::$factory($input['type']);
    }
    public function posttable(Request &$request){
        $post = $request->post('system_images');
        foreach ($post as $k => $v){
            $post[$k]['create_time'] = time();
        }
        App::database()->model('system_images')->insertAll($post);
        return [];
    }
}