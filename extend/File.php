<?php
// +----------------------------------------------------------------------
// | zhanshop-php / File.php [ 2023/2/2 下午7:18 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace extend;

class File
{
    /**
     * 日志写入
     * @access protected
     * @param array  $message     日志信息
     * @param string $destination 日志文件
     * @return bool
     */
    public function write(string &$message): bool
    {
        var_dump($message);
        return true;
        //return error_log($message, 3, $this->getDestination());
    }
}