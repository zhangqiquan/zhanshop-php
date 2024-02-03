<?php
// +----------------------------------------------------------------------
// | admin / Gitee.php    [ 2023/6/28 下午5:56 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\plugin;

use app\task\GieeTask;
use zhanshop\App;
use zhanshop\Log;

class Gitee
{
    protected  $pullBranch = 'master';
    /**
     * 获取事件
     * @param string $hookName
     * @param bool $create
     * @param bool $delete
     * @return string
     */
    protected function getEvent(string $hookName, bool $create, bool $delete){
        if($hookName == 'push_hooks'){
            return 'push';
        }
        return 'other';
    }

    /**
     * 分支
     * @param string $ref
     * @return string
     */
    protected function gitBranch(string $ref){
        $arr = explode('/', $ref);
        $branch = $arr[count($arr) - 1];
        return $branch;
    }
    public function data($data){
        $arr = $data ?? [];
        $event = $this->getEvent($arr['hook_name'] ?? '', (bool)($arr['created'] ?? false), (bool)($arr['deleted'] ?? false));
        if($this->pullBranch == $this->gitBranch($arr['ref'] ?? '')){
            if($event == 'push'){
                $gitUrl = $arr['repository']['clone_url'] ?? '';
                if($gitUrl){
                    App::task()->callback([
                        GieeTask::class,
                        'pull'
                    ], $gitUrl, $this->pullBranch);
                }
                Log::errorLog(SWOOLE_LOG_NOTICE, $gitUrl.' ' . $this->pullBranch.'分支推送了代码');
            }
        }
    }
}