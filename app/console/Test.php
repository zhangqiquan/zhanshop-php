<?php
// +----------------------------------------------------------------------
// | zhanshop-php / Test.php [ 2023/2/2 下午10:13 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\console;

use zhanshop\console\Command;
use zhanshop\console\Input;
use zhanshop\console\Output;

class Test extends Command
{

    public function configure(){
        $this->setTitle('test')->setDescription('测试用例');
    }

    public function execute(Input $input, Output $output)
    {
        // TODO: Implement execute() method.
    }
}