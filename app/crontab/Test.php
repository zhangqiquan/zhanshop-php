<?php
// +----------------------------------------------------------------------
// | zhanshop-php / Test.php [ 2023/2/2 下午10:12 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\crontab;

use zhanshop\App;
use zhanshop\Crontab;

class Test extends Crontab
{
    public function configure()
    {
        $this->setTitle("每天3秒执行一次")->interval(3);
    }

    public function execute()
    {
        App::task()->callback([
            \app\task\Test::class,
            'echo'
        ], 1, 2, 3);
    }
}