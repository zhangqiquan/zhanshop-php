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
use app\api\admin\v1\controller\Proxy;
use app\task\AndroidBossSearchJobTask;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use zhanshop\App;
use zhanshop\console\Command;
use zhanshop\console\Input;
use zhanshop\console\Output;
use zhanshop\console\TaskManager;
use zhanshop\Curl;
use zhanshop\Request;

class Test extends Command
{

    public function configure(){
        $this->setTitle('test')->useDatabase()->setDescription('测试用例');
    }

    public function execute(Input $input, Output $output)
    {
    }
}