<?php
// +----------------------------------------------------------------------
// | zhanshop-device / Containervolume.php    [ 2024/1/17 下午10:38 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2024 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\finder;

use app\api\admin\v1\service\finder\BaseFinder;
use zhanshop\App;
use zhanshop\docker\Volume;
use zhanshop\Request;
use zhanshop\Response;

class Containervolume extends BaseFinder
{
    protected $page = [
        'first' => false,
        'last' => false,
        'layout' => ['count']
    ];

    protected function getCols(string $schma){
        $this->menuData['pk'] = 'name';
        return [
            'name' => array (
                'field' => 'name',
                'title' => '名称',
                'width' => 220,
            ),
            'driver' => [
                'field' => 'driver',
                'title' => '驱动程序',
                'type' => 'text',
                'default' => 'local',
                'width' => 180,
            ],
            'options' => [
                'field' => 'options',
                'title' => '驱动参数',
                'type' => 'text',
                'default' => '',
                'width' => 180,
            ],
            'labels' => [
                'field' => 'labels',
                'title' => '元数据',
                'type' => 'text',
                'default' => '',
                'in_list' => false,
                'width' => 180,
            ],
            '_cluster_volumespec' => [
                'field' => '_cluster_volumespec',
                'title' => '群集的选项',
                'type' => 'text',
                'default' => '',
                'in_list' => false,
                'width' => 180,
            ],
            'mountpoint' => [
                'field' => 'mountpoint',
                'title' => '挂载点',
                'width' => 320,
                'input_type' => 'hidden',
            ],
            '_status' => array (
                'field' => '_status',
                'title' => '状态',
                'width' => 120,
                'input_type' => 'hidden',
                'in_list' => false,
            ),
            '_size' => array (
                'field' => '_size',
                'title' => '大小',
                'width' => 120,
                'input_type' => 'hidden',
                'in_list' => false,
            ),
            'createdat' => array (
                'field' => 'createdat',
                'title' => '创建时间',
                'input_type' => 'hidden',
                'width' => 220,
            )
        ];
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
        $listData = App::make(Volume::class)->getList()['volumes'];
        return [
            'list' => $listData,
            'total' => count($listData),
        ];
    }

    public function post(Request &$request, Response &$response){
        $post = $request->post('0');
        $name = $post['_name'];
        App::make(Volume::class)->create($name);
        //App::make(TaskManager::class)->callback(ImagePull::class, $name);
        return [];
    }

    public function delete(Request &$request, Response &$response)
    {
        $ids = $request->param('pk');
        foreach ($ids as $id){
            try {
                App::make(Volume::class)->delete($id);
            }catch (\Throwable $e){}

        }
        return [];
    }
}