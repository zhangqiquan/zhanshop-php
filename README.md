# zhanshop-php

## 简介
zhanshop-php 是一个基于swoole高性能轻量级框架、全程非阻塞、凭借swoole底层将php函数进行epoll非阻塞化和php自身低开销特点爆发强劲的性能，性能较传统基于 PHP-FPM 的框架有质的提升，提供超高性能的同时，也保持着极其灵活的可扩展性， 一键快速生成业务逻辑层代码骨架，只需要编写业务逻辑代码即可，根据注释配置即可生成api文档，对PDO 和 redis连接池进行了封装，同一连接内事务支持，不同连接和不同数据库服务器之前的分布式事务等功能，全程APP容器化管理，数据库操作类和缓存操作类和thinkphp类似，简单易用。

## server组成
1. 业务层(包含控制器、service、model)
2. crontab (定时任务进程，可将任务丢给task执行, 自带提供的定时有监听代码变化热更新server)
3. task (task任务)

## Server事件通知
config/sns.php
robot
支持 钉钉、 企业微信、飞书 群机器人， 将服务器的启动 重启 重载 Server发生异常错误 进行及时消息提醒

## 日志收集
config/log.php  
type 目前支持3种收集类型

1：File 写入到本地,再结合阿里云/腾讯云日志收集工具将日志收集到阿里云/腾讯云日志服务 （推荐）

2：Es 将日志批量写入到Elasticsearch

3： 写入到数据库中

## 环境要求
php8.1 以上版本，需要redis扩展的支持， pdo mysql 扩展的支持，swoole4.8 以上的扩展支持

## 关于热更新
非vendor, runtime, public目录下的php文件只要发生了变更就会触发更新
注意修改了 .dev.*的配置文件和 修改了 config目录下的 app.php 请手动进行重新启动

示例 php cmd.php server:http restart

## 提供测试数据
在项目目录下有一个 zhanshop.sql 文件 想要把后台管理系统跑起来 需要把zhanshop.sql导入到 mysql数据库中，建议mysql使用8.0以上版本, 


## 性能表现 （供参考和对比）
1. 本框架http服务器，在我的（本机4核，16G ubuntu22 设备上）使用ab压力测试工具 吞吐量可达10万多/s ， 在开启日志写入功能后吞吐量任然在9万多/s
2. swoole 提供的空的http 服务器代码demo 在我的（本机4核，16G ubuntu22 设备上）使用ab压力测试工具 吞吐量达到11万多，性能损耗主要在框架代码 、路由、task、crontab上
3. 和nginx静态访问和自己研发的C++服务器对比 nginx在开启日志访问的情况下吞吐量10万多/s，自己基于C++开发的没有业务逻辑的http服务器吞吐量可达13万/s, 可见swoole php对比c/c++语言的损耗大致10%左右。
4. 对比PHP-FPM 进程池 仅输出一个 echo 1; 在我的（本机4核，16G ubuntu22 设备上）使用ab压力测试工具吞吐量最多能达到1.8万/s
5. 对比其他框架 thinkphp 控制器上简单返回 在我的（本机4核，16G ubuntu22 设备上）使用ab压力测试工具吞吐量最多能达到1千多/s， laravel就会更差。


## 目录结构
~~~

├─app           应用目录
│  ├─console        应用层控制台程序
│  ├─crontab        定时任务目录
│  ├─http           http服务控制逻辑层
│  ├─model          模型目录
│  └─task           task任务目录
│
├─config                配置目录
│  ├─autoload           server载入配置目录
│  │  ├─autoload   
│  │  │    ├─http.php  http服务器配置参数，task任务的注册配置和crontab定时任务的注册配置
│  │  │    └─ ...       
│  ├─app.php            应用配置
│  ├─cache.php          缓存配置
│  ├─console.php        控制台配置
│  ├─database.php       数据库配置
│  ├─ini.php            ini配置
│  └─log.php            日志配置
├─route                 路由定义目录
│  ├─http               路由定义文件
│  │  └─v1.0.0.php      注册的目录版本配置文件
│  └─ ...   
│
├─public                WEB目录
├─extend                扩展类库目录
├─runtime               应用的运行时目录（可写，可定制）
├─vendor                Composer类库目录
│  ├─Container.php      单例容器类
│  ├─App.php            APP管理器
│  ├─Config.php         配置参数管理
│  ├─Console.php        控制台程序入口
│  ├─Cache.php          redis缓存管理类     
│  ├─Database.php       数据库操作管理入口类
│  ├─Helper.php         帮助函数
│  ├─Log.php            日志类
│  ├─Middleware.php     控制器中间件管理
│  ├─RequestCache.php   请求缓存【相当于nginx的程序内部缓存】
│  ├─Route.php          路由管理类
│  ├─Service.php        service单例管理
│  ├─Task.php           task任务管理
│  ├─Validate.php       请求参数验证
│  ├─console            控制台程序目录(包含http服务器,后台管理系统等程序)
│  └─ ...  
├─.env.dev              本地开发环境变量示例文件
├─.env.test             测试环境变量示例文件
├─.env.production       生产环境变量示例文件
├─composer.json         composer 定义文件
├─LICENSE.txt           授权说明文件
├─README.md             README 文件
├─cmd.php               命令行入口文件

~~~

## 框架安装

~~~
composer require zhanshop/framework

~~~

## 完整的初始化项目

~~~
https://github.com/zhangqiquan/zhanshop-php.git
~~~


## 控制台使用方法
~~~
php cmd.php

欢迎使用zhanshop控制台系统

用法:   cmd 指令 --参数 参数信息

可用命令：

help                                帮助 - 显示命令的帮助
server:http                         启动http服务 - 使用该命令可以创建一个http服务器
server:admin                        启动后台管理系统 - 使用该命令可以创建一个http后台管理系统
api:create                          api构建 - 一键生成http接口
api:manager                         api管理 - 对现有的文档数据进行(修改/删除/清空/回滚/生成等功能)
test:demo                           test - 测试用例

~~~


## 配置开机启动脚本

~~~
拿server:http 举例

vim /etc/systemd/system/zhanshop_http.service

[Unit]
Description=zhanshop-http - high performance web server
After=network.target
[Service]
Type=forking
ExecStart=php 项目路径/cmd.php server:http start
ExecReload=php 项目路径/cmd.php server:http reload
ExecStop=php 项目路径/cmd.php server:http stop
Execenable=php 项目路径/cmd.php server:http start
[Install]
WantedBy=multi-user.target

保存后

systemctl enable zhanshop_http.service

~~~

## 演习地址
~~~
后台管理系统：
http://36.111.20.204:6300/admin/
账号: admin
密码: admin123

http接口服务：
http://36.111.20.204:6200/apiDoc

访问密码： zhangqiquan123

~~~


## api使用方法


~~~
1.生成路由

php cmd.php api:create // 使用命令生成路由
php cmd.php apidoc:manager // 当代码和注释发生变更使用该命令进行 修改/删除/清空/回滚/生成
对框架生成的service进行业务开发即可
~~~

~~~
2.数据模型

<?php
namespace app\model;
use zhanshop\database\Model;

class Abc extends Model
{
    // 设置当前模型的对应数据表
    protected $table = '对应的表名';

    // 设置当前模型的数据库连接
    protected $connection = '连接配置名称';

}
~~~

~~~
3.数据库模型使用案例

App::database()->model('表名')->where(['id' => 123])->find();  // 查询单个数据
App::database()->model('表名')->where(['a' => 123])->finder(); // 分页查询
App::database()->model('表名')->save([...]);  // 新增数据
App::database()->model('表名')->where(['id' => 123])->delete(); // 删除


事务 当闭包中的代码发生异常会自动回滚
App::database()->transaction(function($pdo){
    Test::insert([
        'a' => '1',
        'b' => '2',
        'c' => '3'
    ], $pdo);
    Test::insert([
        'a1' => '1',
        'b' => '2',
        'c' => '3'
    ], $pdo);
});

分布式事务【在数据库开启分布式事务后才可以正常使用】
App::database()->transactionXa(function($pdos){
    Test::insert([
        'a' => '1',
        'b' => '2',
        'c' => '3'
    ], $pdo[0]);
    Test1::insert([
        'a' => '1',
        'b' => '2',
        'c' => '3'
    ], $pdo[1]);
});

4.缓存使用
App::cache()->get(...);
App::cache()->set(...);

更多方法详见 https://blog.csdn.net/demored/article/details/123842206 以及 php官方文档


等等....
~~~

## 交流群
由于微信群无法直接加入，故可先加下方二维码好友，并声明目的，再拉您入群。

微信号： eee7798
![](http://test-cdn.zhanshop.cn/2023313/167870337640814238.jpg)
