<?php

use zhanshop\App;
use zhanshop\cache\CacheManager;
use zhanshop\database\DbManager;

require __DIR__ . '/load/auto.php';

(new App(BASE_PATH))->console();
if(extension_loaded('swoole')){
    CacheManager::init(); // 缓存管理初始化
    DbManager::init(); // 数据库管理初始化
}




/**
由Sebastian Bergmann和贡献者撰写的PHPUnit 10.1.1。

Usage:
phpunit [options] UnitTest.php
phpunit [options] <directory>

Configuration:

--bootstrap <file>               测试运行前包含的PHP脚本
-c|--configuration <file>        从XML文件读取配置
--no-configuration               忽略默认配置文件（phpunit.xml）
--no-extensions                  不加载PHPUnit扩展
--include-path <path(s)>         使用给定的路径预处理PHP的include_path
-d <key[=value]>                 设置php.ini值
--cache-directory <dir>          指定缓存目录
--generate-configuration         使用建议的设置生成配置文件
--migrate-configuration          将配置文件迁移到当前格式

Selection:

--list-suites                    列出可用的测试套件
--testsuite <name>               仅运行指定测试套件中的测试
--exclude-testsuite <name>       从指定的测试套件中排除测试
--list-groups                    列出可用的测试组
--group <name>                   仅运行指定组中的测试
--exclude-group <name>           从指定的组中排除测试
--covers <name>                  仅运行打算覆盖＜name＞的测试
--uses <name>                    仅运行打算使用＜name＞的测试
--list-tests                     列出可用的测试
--list-tests-xml <file>          以XML格式列出可用的测试
--filter <pattern>               筛选要运行的测试
--test-suffix <suffixes>         仅在具有指定后缀的文件中搜索测试。默认值：Test.php、.phpt

Execution:

--process-isolation              在单独的PHP进程中运行每个测试
--globals-backup                 每次测试的备份和恢复$GLOBALS
--static-backup                  备份和恢复每个测试的静态财产

--strict-coverage                严格对待代码覆盖率元数据
--strict-global-state            严格对待全球状态的变化
--disallow-test-output           在测试过程中严格要求输出
--enforce-time-limit             根据测试大小强制执行时间限制
--default-time-limit <sec>       没有声明大小的测试的超时时间（秒）
--dont-report-useless-tests      不报告不测试任何内容的测试

--stop-on-defect                 在第一次错误、失败、警告或风险测试后停止
--stop-on-error                  第一次出错后停止
--stop-on-failure                第一次故障后停止
--stop-on-warning                第一次警告后停止
--stop-on-risky                  第一次风险测试后停止
--stop-on-deprecation            在触发弃用的第一次测试后停止
--stop-on-notice                 在触发通知的第一次测试后停止
--stop-on-skipped                第一次跳过测试后停止
--stop-on-incomplete             第一次未完成测试后停止

--fail-on-warning                触发警告时使用shell退出代码发出信号失败
--fail-on-risky                  当测试被认为有风险时，使用shell退出代码发出信号失败
--fail-on-deprecation            触发弃用时使用shell退出代码发出信号失败
--fail-on-notice                 触发通知时使用shell退出代码发出信号失败
--fail-on-skipped                跳过测试时使用shell退出代码发出信号失败
--fail-on-incomplete             当测试被标记为不完整时，使用shell退出代码发出信号失败

--cache-result                   将测试结果写入缓存文件
--do-not-cache-result            不将测试结果写入缓存文件

--order-by <order>               按顺序运行测试：默认|缺陷|依赖|持续时间|不依赖|随机|反向|大小
--random-order-seed <N>          以随机顺序运行测试时使用指定的随机种子

Reporting:

--colors <flag>                  在输出中使用颜色（“从不”、“自动”或“始终”）
--columns <n>                    用于进度输出的列数
--columns max                    使用进度输出的最大列数
--stderr                         写入STDERR而不是STDOUT

--no-progress                    禁用测试执行进度的输出
--no-results                     禁用测试结果输出
--no-output                      禁用所有输出

--display-incomplete             显示未完成测试的详细信息
--display-skipped                显示跳过测试的详细信息
--display-deprecations           显示测试触发的弃用的详细信息
--display-errors                 显示测试触发的错误的详细信息
--display-notices                显示测试触发的通知的详细信息
--display-warnings               显示测试触发的警告的详细信息
--reverse-list                   按相反顺序打印缺陷

--teamcity                       将默认进度和结果输出替换为TeamCity格式
--testdox                        将默认结果输出替换为TestDox格式

Logging:

--log-junit <file>               将JUnit XML格式的测试结果写入文件
--log-teamcity <file>            以TeamCity格式将测试结果写入文件
--testdox-html <file>            将测试结果以TestDox格式（HTML）写入文件
--testdox-text <file>            将测试结果以TestDox格式（纯文本）写入文件
--log-events-text <file>         将事件以纯文本形式流式传输到文件
--log-events-verbose-text <file> 将事件以纯文本形式（带有遥测信息）流式传输到文件
--no-logging                     忽略XML配置文件中配置的日志记录

Code Coverage:

--coverage-clover <file>         将Clover XML格式的代码覆盖率报告写入文件
--coverage-cobertura <file>      将Cobertura XML格式的代码覆盖率报告写入文件
--coverage-crap4j <file>         将Crap4J XML格式的代码覆盖率报告写入文件
--coverage-html <dir>            将HTML格式的代码覆盖率报告写入目录
--coverage-php <file>            将序列化的代码覆盖率数据写入文件
--coverage-text=<file>           将文本格式的代码覆盖率报告写入文件[默认值：标准输出]
--coverage-xml <dir>             将XML格式的代码覆盖率报告写入目录
--warm-coverage-cache            热静态分析缓存
--coverage-filter <dir>          在代码覆盖率报告中包含＜dir＞
--path-coverage                  除线路覆盖率外，还报告路径覆盖率
--disable-coverage-ignore        禁用忽略代码覆盖率的元数据
--no-coverage                    忽略XML配置文件中配置的代码覆盖率报告

Miscellaneous:

-h|--help                        打印此使用情况信息
--version                        打印版本并退出
--atleast-version <min>          检查版本是否大于＜min＞并退出
--check-version                  检查PHPUnit是否为最新版本并退出

 */