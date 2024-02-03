<?php
// +----------------------------------------------------------------------
// | zhanshop-device / ContainerLists.php    [ 2024/1/17 下午4:55 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2024 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\finder;

use zhanshop\App;
use zhanshop\docker\Container;
use zhanshop\docker\Images;
use zhanshop\docker\Volume;
use zhanshop\Request;
use zhanshop\Response;


class ContainerLists extends BaseFinder
{
    protected $page = [
        'first' => false,
        'last' => false,
        'layout' => ['count']
    ];


    protected $rowToolbar = [
        [
            'event' => 'ajax',
            'ico' => '&#xe642;',
            'title' => '启动容器',
            'method' => 'start',
            'condition' => '[["status", "==", "已停止"]]',
            'page' => '',
        ],
        [
            'event' => 'ajax',
            'ico' => '&#xe642;',
            'title' => '重启容器',
            'method' => 'restart',
            'condition' => '[["status", "==", "运行中"]]',
            'page' => '',
        ],
        [
            'event' => 'ajax',
            'ico' => '&#xe642;',
            'title' => '停止容器',
            'method' => 'stop',
            'condition' => '[["status", "==", "运行中"]]',
            'page' => '',
        ],
        [
            'event' => 'ajax',
            'ico' => '&#xe642;',
            'title' => '暂停容器',
            'method' => 'pause',
            'condition' => '[["status", "==", "运行中"]]',
            'page' => '',
        ],
        [
            'event' => 'delete',
            'ico' => '&#xe642;',
            'title' => '删除容器',
            'method' => '',
            'condition' => '',
            'page' => '',
        ],
        [
            'event' => 'open',
            'ico' => '&#xe642;',
            'title' => '容器日志',
            'method' => '',
            'field' => '',
            'page' => './container/logs.html',
        ],
        [
            'event' => 'open',
            'ico' => '&#xe642;',
            'title' => '容器详情',
            'method' => '',
            'page' => './container/detail.html',
        ],
        [
            'event' => 'open',
            'ico' => '&#xe642;',
            'title' => '容器网络',
            'method' => '',
            'page' => './container/network.html',
        ]
    ];

    protected function getCols(string $schma){
        $cols = [
            '_id' => array (
                'field' => '_id',
                'title' => 'ID',
                'input_type' => 'hidden',
                'width' => 180,
            ),
            '_names' => array (
                'field' => '_names',
                'title' => '容器名称',
                'width' => 220,
            ),
            'image' => array (
                'field' => 'image',
                'title' => '镜像',
                'width' => 280,
                'input_type' => 'select',
                'value' => []
            ),
            '_ports' => array (
                'field' => '_ports',
                'title' => '端口',
                'width' => 170,
            ),
            '_env_var' => array (
                'field' => '_env_var',
                'title' => '环境变量',
                'input_type' => 'select',
                'in_list' => false,
                'value' => []
            ),
            '_volume' => array (
                'field' => '_volume',
                'title' => '挂载卷',
                'width' => 170,
                'input_type' => 'select',
                'in_list' => false,
                'value' => []
            ),
            '_cmd' => array (
                'field' => '_cmd',
                'title' => '启动命令',
                'width' => 280,
                'input_type' => 'text',
                'in_list' => false,
                'value' => []
            ),
            '_status' => array (
                'field' => '_status',
                'title' => '状态',
                'width' => 120,
                'input_type' => 'hidden',
            ),
            '_last_started' => array (
                'field' => '_last_started',
                'title' => '上次启动',
                'width' => 120,
                'input_type' => 'hidden',
            ),
            '_creat_time' => array (
                'field' => '_creat_time',
                'title' => '创建时间',
                'input_type' => 'time',
                'width' => 170,
                'input_type' => 'hidden',
            )
        ];
        $cols['image']['value'] = $this->images();
        $cols['_env_var']['value'] = $this->envs();
        $cols['_volume']['value'] = $this->volumes();
        return $cols;
    }

    private function images()
    {
        $listData = App::make(Images::class)->getList();
        $images = [];
        foreach($listData as $v){
            $images[$v['repotags'][0] ?? "unknown"] = $v['repotags'][0] ?? "unknown";
        }
        return $images;
    }

    private function envs()
    {
        return App::database()->model("container_envs")->column("title", "id");
    }

    private function volumes()
    {
        $listData = App::make(Volume::class)->getList()['volumes'];
        $names = [];
        foreach($listData as $v){
            $names[$v['name']] = $v['name'];
        }
        return $names;
    }

    /**
     * 容器列表数据
     * @param int $page
     * @param int $limit
     * @param array $search
     * @return array
     * @throws \Exception
     */
    protected function data(int $page, int $limit, array $search){
        $listData = App::make(Container::class)->getList();
        foreach($listData as $k => $v){
            $listData[$k]['_id'] = substr($v['id'], 0, 12);
            $listData[$k]['_names'] = str_replace('/', '', implode(',', $v['names']));
            $listData[$k]['_status'] = $v['state'] == 'running' ? "运行中" : "已停止";
            if($v['state'] == 'paused') $listData[$k]['_status'] = "暂停";
            $listData[$k]['_creat_time'] = date('Y-m-d H:i:s', $v['created']);
            $port = "";
            foreach ($v['ports'] as $vv){
                $port .= ($vv["ip"] ?? "").':'.($vv['privateport'] ?? "").":".($vv['publicport'] ?? "").'/'.($vv['type'] ?? 'tcp').' ';
            }
            $listData[$k]['_ports'] = $port;
            $listData[$k]['_last_started'] = $v['status'];
        }
        return [
            'list' => $listData,
            'total' => count($listData),
        ];
    }
    /**
     * 启动容器
     * @param Request $request
     * @param Response $response
     * @return mixed|void
     * @throws \Exception
     */
    public function start(Request &$request, Response &$response)
    {
        $id = $request->param('id');
        App::make(Container::class)->start($id);
        $list = $this->data(1, 100, [])['list'];
        foreach($list as $v){
            if($v['id'] == $id) return $v;
        }
    }
    /**
     * 重启容器
     * @param Request $request
     * @param Response $response
     * @return mixed|void
     * @throws \Exception
     */
    public function restart(Request &$request, Response &$response)
    {
        $id = $request->param('id');
        App::make(Container::class)->restart($id);
        $list = $this->data(1, 100, [])['list'];
        foreach($list as $v){
            if($v['id'] == $id) return $v;
        }
    }
    /**
     * 暂停容器
     * @param Request $request
     * @param Response $response
     * @return mixed|void
     * @throws \Exception
     */
    public function pause(Request &$request, Response &$response)
    {
        $id = $request->param('id');
        App::make(Container::class)->pause($id);
        $list = $this->data(1, 100, [])['list'];
        foreach($list as $v){
            if($v['id'] == $id) return $v;
        }
    }

    /**
     * 停止容器
     * @param Request $request
     * @param Response $response
     * @return mixed|void
     * @throws \Exception
     */
    public function stop(Request &$request, Response &$response){
        $id = $request->param('id');
        App::make(Container::class)->stop($id);
        $list = $this->data(1, 100, [])['list'];
        foreach($list as $v){
            if($v['id'] == $id) return $v;
        }
    }

    /**
     * 删除容器
     * @param Request $request
     * @param Response $response
     * @return array
     */
    public function delete(Request &$request, Response &$response)
    {
        $ids = $request->param('pk');
        $list = $this->data(1, 100, [])['list'];
        foreach ($ids as $id){
            foreach($list as $v){
                if($v['id'] == $id && $v['state'] != "exited"){
                    App::error()->setError($v['_id'].'尚未停止', 403);
                }
            }
            App::make(Container::class)->delete($id);
        }
        return [];
    }

    public function post(Request &$request, Response &$response){
        $post = $request->post('0');

        print_r($post);
    }
}