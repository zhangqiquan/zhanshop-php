<?php
// +----------------------------------------------------------------------
// | zhanshop-device / ContainerImages.php    [ 2024/1/13 下午2:12 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2024 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\finder;

use app\task\docker\ImagePull;
use zhanshop\App;
use zhanshop\console\TaskManager;
use zhanshop\docker\Images;
use zhanshop\Request;
use zhanshop\Response;

class ContainerImages extends BaseFinder
{
    protected $page = [
        'first' => false,
        'last' => false,
        'layout' => ['count']
    ];

    protected $headToolbar = [
        [
            'event' => 'add',
            'ico' => '&#xe608;',
            'title' => '下载',
            'method' => '',
            'page' => './page/container/add-image.html',
        ],
        [
            'event' => 'deletes',
            'ico' => '&#xe640;',
            'title' => '删除',
            'method' => '',
            'page' => '',
        ],
    ];

    protected $rowToolbar = [
        [
            'event' => 'open',
            'ico' => '&#xe642;',
            'title' => '启动镜像',
            'method' => '',
            'condition' => '',
            'page' => './container/start.html',
        ],
        [
            'event' => 'delete',
            'ico' => '&#xe642;',
            'title' => '删除镜像',
            'method' => '',
            'condition' => '',
            'page' => '',
        ],
    ];

    protected function getCols(string $schma){
        //$this->menuData['pk'] = 'id';
        return [
            'id' => [
                'field' => 'id',
                'title' => '镜像ID',
                'type' => 'text',
                'width' => 180,
            ],
            '_names' => array (
                'field' => '_names',
                'title' => '镜像名称',
                'type' => 'text',
                'width' => 380,
            ),
//            'status' => array (
//                'field' => 'status',
//                'title' => '状态',
//                'type' => 'text',
//                'width' => 220,
//            ),
            '_size' => array (
                'field' => '_size',
                'title' => '镜像大小',
                'type' => 'int',
                'input_type' => 'hidden',
                'width' => 120,
            ),
            '_creat_time' => array (
                'field' => '_creat_time',
                'title' => '创建时间',
                'type' => 'int',
                'input_type' => 'hidden',
                'width' => 170,
            ),
        ];
    }

    protected function data(int $page, int $limit, array $search){
        $listData = App::make(Images::class)->getList();
        foreach($listData as $k => $v){
            $listData[$k]['id'] = substr(explode(':', $v['id'])[1], 0, 12);
            $listData[$k]['_names'] = implode(',', $v['repotags']);
            $listData[$k]['_creat_time'] = date('Y-m-d H:i:s', $v['created']);
            $listData[$k]['_size'] = round($v['size'] / 1000 / 1000, 2).'MB';
        }
        return [
            'list' => $listData,
            'total' => count($listData),
        ];
    }

    /**
     * 删除镜像
     * @param Request $request
     * @param Response $response
     * @return array
     */
    public function delete(Request &$request, Response &$response)
    {
        $ids = $request->param('pk');
        foreach ($ids as $id){
            App::make(Images::class)->delete($id);
        }
        return [];
    }

    /**
     * 拉取新镜像
     * @param Request $request
     * @param Response $response
     * @return array
     */
    public function post(Request &$request, Response &$response){
        $post = $request->post('0');
        $name = $post['_names'];
        if(count(explode(":", $name)) < 2) App::error()->setError("镜像名称中请包含版本号");
        App::make(TaskManager::class)->callback(ImagePull::class, $name);
        return [];
    }

    /**
     * 镜像拉取进度
     * @param Request $request
     * @param Response $response
     * @return null
     */
    public function pullProgress(Request &$request, Response &$response)
    {
    }
}