<?php
// +----------------------------------------------------------------------
// | zhanshop-swoole / Output.php    [ 2021/12/30 5:08 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);


namespace zhanshop\console;


class Output
{
    protected  $styles = [
        'success' => "\033[0;32m%s\033[0m",
        'error' => "\033[31;31m%s\033[0m",
        'info' => "\033[33;33m%s\033[0m",
    ];

    /**
     * 状态码
     * @var integer
     */
    protected $code = 0;

    /**
     * 原始数据
     * @var mixed
     */
    protected $data;

    /**
     * 发送数据到客户端
     * @access public
     * @return void
     * @throws \InvalidArgumentException
     */
    public function send(): void
    {
        // 处理输出数据
        $this->output($this->getData(), $this->getCode() == 0 ? 'success' : 'error');
    }

    /**
     * 获取输出数据
     * @return mixed
     */
    public function getData(){
        return $this->data;
    }

    /**
     * 设定状态
     * @access public
     * @param  integer $code 状态码
     * @return $this
     */
    public function code(int $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * 获取状态码
     * @access public
     * @return integer
     */
    public function getCode(): int
    {
        return $this->code;
    }
    /**
     * 写入数据
     * @access public
     * @param  mixed $data 输出数据
     * @return $this
     */
    public function write($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @输出支持带色彩的文字
     * @param string $msg
     * @param string $style
     */
    public function output(mixed $msg = '', $style = 'info', $newLine = true) : void{
        if (isset($this->styles[$style])) {
            $format =$this->styles[$style];
        }

        if ($newLine) {
            $format .= PHP_EOL;
        }
        printf(''.$format, $msg);
    }

    /**
     * 系统异常处理
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param string $errline
     */
    public static function render(int $errno, string $errstr, string $errfile, mixed $errline){
        throw new \Exception($errstr.' :errfile:'.$errfile.', line:'.$errline, 500);
    }

    /**
     * 用户自定义的异常处理
     * @param \Throwable $exception
     */
    public static function exception(\Throwable $exception){
        echo PHP_EOL;
        printf("\033[33;33m%s\033[0m", $exception->getMessage().PHP_EOL.PHP_EOL);
        echo $exception->getFile().'第'.$exception->getLine().'行'.PHP_EOL;
        printf("\033[31;31m%s\033[0m", $exception->getTraceAsString());
    }
}