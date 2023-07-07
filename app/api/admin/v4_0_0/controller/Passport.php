<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / Passport.php    [ 2023/3/4 21:38 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: Administrator <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\controller;

use app\api\admin\Controller;
use app\api\admin\v4_0_0\middleware\Authenticate;
use app\api\admin\v4_0_0\service\IndexService;
use app\api\admin\v4_0_0\service\PassportService;
use zhanshop\App;
use zhanshop\Csv;
use zhanshop\Request;
use zhanshop\Response;

class Passport extends Controller
{

    /**
     * 登陆
     * @param Request $request
     * @return array
     */
    public function login(Request &$request){

        $data = $request->validate([
            'user_name' => 'required',
            'password' => 'required',
            'remote_addr' => '',
            'user-agent' => '',
        ])->getData();

        $data['remote_addr'] = $request->server('remote_addr');
        $data['user-agent'] = $request->header('user-agent', "");

        $data = App::make(PassportService::class)->login(...array_values($data));
        App::cache()->set(Authenticate::ADMIN_AUTH_KEY.$data['user_id'], $request->time(), Authenticate::TOKEN_EXPIRE);

        return $this->result($data);
    }
}