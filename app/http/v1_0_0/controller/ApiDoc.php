<?php
// +----------------------------------------------------------------------
// | zhanshop-php / ApiDoc.php [ 2023/2/2 下午7:30 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\http\v1_0_0\controller;

use app\http\Controller;
use zhanshop\App;
use zhanshop\service\ApiDocService;

class ApiDoc extends Controller
{
    public function login(mixed &$request){
        $input = &App::validate()->check($request->post, [
            'pwd' => 'Required'
        ]);
        if($input['pwd'] != 'zhangqiquan') App::error()->setError('访问密码不正确', 403);
        return [];
    }

    public function apis(mixed &$request){
        return App::service()->get(ApiDocService::class)->getTab();
    }

    public function detail(mixed &$request){
        if($request->server['request_method'] == 'GET'){
            $input = &App::validate()->check($request->get, [
                'uri' => 'Required',
                'version' => 'Required',
            ]);
            return App::service()->get(ApiDocService::class)->getDetail($input['version'], $input['uri']);
        }else if($request->server['request_method'] == 'POST'){
            $input = &App::validate()->check($request->post, [
                'uri' => 'Required',
                'version' => 'Required',
                'detail' => 'Required',
            ]);
            return App::service()->get(ApiDocService::class)->edit($input['version'], $input['uri'], ['detail' => $input['detail']]);
        }
    }

    public function debug(mixed &$request){
        if(!in_array($request->server['remote_addr'], ['127.0.0.1', "::1"])) return [];
        $input = &App::validate()->check($request->post, [
            'uri' => 'Required',
            'version' => 'Required',
            'http_code' => 'Required',
            'result' => 'Required',
            'request_method' => 'Required',
        ]);
        if($input['result']) $input['result'] = json_decode($input['result'], true);
        // 先获取后更新
        $detail = App::service()->get(ApiDocService::class)->getDetail($input['version'], $input['uri'])['data'];
        if($input['http_code'] == 200){
            $detail['success'][strtoupper($input['request_method'])] = $input['result'];
            $input['success'] = json_encode($detail['success'], JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE);
        }else{
            $detail['failure'][strtoupper($input['request_method'])] = $input['result'];
            $input['failure'] = json_encode($detail['failure'], JSON_UNESCAPED_SLASHES + JSON_UNESCAPED_UNICODE);
        }
        unset($input['http_code'], $input['request_method'], $input['result']);
        return App::service()->get(ApiDocService::class)->edit($input['version'], $input['uri'], $input);
    }
}