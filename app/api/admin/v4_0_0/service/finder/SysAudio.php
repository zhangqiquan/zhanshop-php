<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / sys_audio.php    [ 2023/2/28 19:01 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\service\finder;

use app\api\admin\v4_0_0\service\plugin\Storagetoken;
use zhanshop\App;
use zhanshop\Request;
use zhanshop\Response;

class SysAudio extends BaseFinder
{
    public function uploadtokentable(Request &$request, Response &$response){
        $input = $request->validate([
            'factory' => 'Required',
            'type' => 'Required'
        ])->getData();
        $factory = $input['factory'];
        return Storagetoken::$factory($input['type']);
    }
    public function posttable(Request &$request, Response &$response){
        $post = $request->post('system_audios');
        foreach ($post as $k => $v){
            $post[$k]['create_time'] = time();
        }
        App::database()->model('system_audios')->insertAll($post);
        return [];
    }
}