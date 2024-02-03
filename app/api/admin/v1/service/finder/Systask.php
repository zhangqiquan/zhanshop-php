<?php
// +----------------------------------------------------------------------
// | zhanshop-device / Systask.php    [ 2024/1/19 下午7:13 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2024 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\finder;

use app\api\admin\v1\service\finder\BaseFinder;
use zhanshop\App;
use zhanshop\console\TaskManager;
use zhanshop\Request;
use zhanshop\Response;

class Systask extends BaseFinder
{

    protected $rowToolbar = [
        [
            'event' => 'edit',
            'ico' => '&#xe642;',
            'title' => '运行过程',
            'method' => '',
            'page' => './page/sys/task-process.html',
        ],
        [
            'event' => 'ajax',
            'ico' => '&#xe642;',
            'title' => '再次启动',
            'condition' => '[["status", "==", "完成"]]',
            'method' => 'restart',
            'page' => '',
        ],
        [
            'event' => 'delete',
            'ico' => '&#xe640;',
            'title' => '删除任务',
            'method' => '',
            'page' => '',
        ],
    ];

    public function process(Request &$request, Response &$response)
    {
        $id = $request->param('id');
        $startLine = $request->param('sline');
        $file = App::runtimePath().'/task/'.$id.'.log';
        $fileData = "";
        $currentLine = 0;
        if(file_exists($file)){
            $handle = fopen($file, "r");
            while(!feof($handle)){
                $currentLine++;
                $line = fgets($handle);
                if($startLine <= $currentLine){
                    $fileData .= $line;
                }else{
                    break;
                }
                if(strlen($fileData) > 20000) break;
            }

            fclose($handle);
        }
        $data = [
            'start' => $startLine,
            'end' =>  $currentLine < $startLine ? $startLine : $currentLine,
            'body' => $fileData
        ];
        return $data;
    }

    protected function data(int $page, int $limit, array $search)
    {
        if(isset($this->menuData['table_names'][0]) == false) App::error()->setError($this->menuData['id'].'的table_names未配置');
        $model = App::database()->model($this->menuData['table_names'][0]);
        foreach($search as $v){
            if($v == false || isset($v[0]) == false || isset($v[1]) == false|| isset($v[2]) == false) continue;
            $v[2] = (string)$v[2];
            switch ($v[1]){
                case "=":
                    $model->whereRaw($v[0]." = '".addslashes($v[2])."'");
                    break;
                case ">=":
                    $model->whereRaw($v[0]." >= '".addslashes($v[2])."'");
                    break;
                case "<=":
                    $model->whereRaw($v[0]." <= '".addslashes($v[2])."'");
                    break;
                case "!=":
                    $model->whereRaw($v[0]." != '".addslashes($v[2])."'");
                    break;
                case "between":
                    $vals = explode(',', $v[2]);
                    $model->whereRaw($v[0]." BETWEEN '".addslashes(($vals[0] ?? "0"))."' AND '".addslashes(($vals[1] ?? "0"))."'");
                    break;
                default:
                    $model->whereRaw($v[0]." LIKE '%".addslashes($v[2])."%'");
            }
        }

        if($this->menuData['pk']){
            $model = $model->order('update_time desc');
        }

        return $model->finder((int)$page, (int)$limit);
    }

    public function restart(Request &$request, Response &$response)
    {
        $id = $request->param('id');
        $row = App::database()->model("tasks")->where(['id' => $id])->find();
        $params = explode(',', $row['param']);
        if($row){
            if($params){
                App::make(TaskManager::class)->callback($row['task'], ...$params);
            }else{
                App::make(TaskManager::class)->callback($row['task']);
            }
        }
    }

    public function post(Request &$request, Response &$response){
        $post = $request->post('0');
        $post['id'] = sha1(getmypid().'-'.microtime(true)).'-0';
        App::database()->model("tasks")->insert($post);
        return [];
    }
}