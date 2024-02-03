<?php
// +----------------------------------------------------------------------
// | flow-course / Container    [ 2021/10/22 4:45 下午 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2021 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace zhanshop;


use zhanshop\cache\CacheManager;
use zhanshop\database\DbManager;

/**
 * 容器管理类 支持PSR-11
 */
class Container
{
    /**
     * 容器对象实例列表
     * @var
     */
    protected static $instances;

    /**
     * 容器绑定标识
     * @var array
     */
    protected static $bind = [
    ];

    /**
     * 绑定别名到一个类
     * @param string $key
     * @param string $class
     * @return void
     */
    public function bind(string $key, string $class){
        $this->bind[$key] = $class;
    }

    /**
     * 通过类名获取类的实例
     * @template Type
     * @param class-string<Type> $className
     * @return Type
     */
    public static function make(string $className, array $vars = [], bool $newInstance = false){
        if (isset(self::$instances[$className]) && !$newInstance) {
            return self::$instances[$className];
        }

        $obj = new $className(...$vars);
        return self::$instances[$className] = $obj;
    }

    /**
     * 通过类名清除类的实例
     * @param string $className
     * @return void
     */
    public static function clean(string $className)
    {
        unset(self::$instances[$className]);
    }

    /**
     * 获取实例
     * @param $name
     * @param array $arguments
     * @return mixed
     * @throws \Exception
     */
    protected static function get(string &$name, array &$arguments){
        $className = static::$bind[$name] ?? throw new \Exception('没有绑定'.$name.'方法关联的类', 500);
        return self::make($className, $arguments);
    }
    /**
     * 容器获取app类
     * @param $name
     * @param array $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call(string $name, array $arguments)
    {
        return self::get($name, $arguments);
    }

    /**
     * 容器获取app类
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic($name, array $arguments)
    {
        return self::get($name, $arguments);
    }

    /**
     * 清理容器上所有类
     * @return void
     */
    public static function cleanAll(){
        self::$instances = [];
    }
}
