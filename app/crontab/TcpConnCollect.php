<?php
// +----------------------------------------------------------------------
// | zhanshop-admin / TcpConnCollect.php    [ 2023/3/11 16:52 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\crontab;
use Swoole\Timer;
use zhanshop\App;

class TcpConnCollect
{
    public function execute($serv){
        Timer::tick(300000, function () use ($serv){
            App::log()->push(json_encode($serv->stats()), 'NOTICE'); // 记录服务器状态
        });

    }
}