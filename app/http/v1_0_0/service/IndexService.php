<?php
// +----------------------------------------------------------------------
// | zhanshop-php / Index.php    [ 2023/1/5 11:54 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\http\v1_0_0\service;

use app\model\CourseCourseware;
use app\model\Test;
use zhanshop\App;
use zhanshop\cache\CacheManager;
use zhanshop\database\DbManager;

class IndexService
{
    // https://blog.csdn.net/qq_36154886/article/details/115318760 .
    public function getIndex(mixed &$request){

        return [123];

//        App::database()->transactionXa(function ($pdos){
//            Test::insert([
//                'a' => '1',
//                'b' => '2',
//                'c' => '3',
//            ], $pdos[0]);
//            CourseCourseware::insert([
//                'courseware_id' => time(),
//                'title' => '1',
//                'keyword' => '1',
//                'thumbnail' => '1',
//                'description' => '1',
//                'cat_id' => '1',
//                'author' => '1',
//                'detail' => '1',
//                'sortrank' => '1',
//                'create_time' => '1',
//            ], $pdos[1]);
//        }, ['mysql', 'test']);
//
//        return;

        App::database()->transaction(function($pdo){
            Test::insert([
                'a' => '1',
                'b' => '2',
                'c' => '3'
            ], false, $pdo);
            Test::insert([
                'a1' => '1',
                'b' => '2',
                'c' => '3'
            ], false, $pdo);
        });


        return [];
        //App::cache()->instance()->set('1', "我是本机");
//        $arr = [];
//        App::cache()->callback(function ($redis) use (&$arr){
//            $arr = [
//                App::cache()->instance($redis)->get('1'),
//                App::cache()->instance($redis)->get('1')
//            ];
//        });
//        return $arr;
//        return [
//            App::cache()->instance()->get('1'),
//            App::cache()->instance()->get('2'),
//            App::cache()->instance()->get('3'),
//            App::cache()->instance()->get('1'),
//            App::cache()->instance()->get('2'),
//            App::cache()->instance()->get('3'),
////            App::cache()->instance('test')->get('1'),
////            App::cache()->instance('default')->get('1'),
//        ];
//        App::cache()->instance(); // 还是有问题 放在响应上
//        App::cache()->instance();
//        $k = time().rand(0, 999999);
//        App::cache()->instance()->set($k, $k, 60);
//        return App::cache()->instance()->get($k);
        //return App::config()->get();
//        App::database()->model("test");
//        App::database()->model("test");
//        $data = App::database()->model("test")->count();
        return Test::find();
        $test = new Test();
        $c = new CourseCourseware();
        return [
            $test->find(),
            $c->find(),
            $test->find(),
        ];
        return $test->find();
        return [
            'test1' => App::database()->table("test")->where(['id' => 3])->find(),
            'cw' => App::database()->table("course_courseware")->where(['courseware_id' => '008OXaQ2208221525158012478140228'])->field('title')->find(),
            'test2' => App::database()->table("test")->where(['id' => 2])->find(),
            'test5' => App::database()->table("user_info", 'test')->where(['user_id' => 3])->find(),
            'c5' => App::database()->table("user_account",'test')->order('rand()')->find(),
            'test6' => App::database()->table("user_info",'test')->where(['user_id' => 1])->find()
        ];
        return "wanmei";
    }

    public function postIndex(mixed &$request){
        return ["postIndex"];
    }

    public function deleteIndex(mixed &$request){
        return ["deleteIndex"];
    }

    public function putIndex(mixed &$request){
        return ["putIndex"];
    }
}