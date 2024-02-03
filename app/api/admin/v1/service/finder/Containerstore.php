<?php

namespace app\api\admin\v1\service\finder;

use zhanshop\App;
use zhanshop\docker\Images;
use zhanshop\Request;
use zhanshop\Response;

class Containerstore extends BaseFinder
{
    protected $page = [
        'first' => false,
        'last' => false,
        'layout' => ['count']
    ];
    protected function getCols(string $schma){
        $this->menuData['pk'] = "name";
        return [
            'name' => array (
                'field' => 'name',
                'title' => '镜像名称',
                'width' => 300,
            ),
            'star_count' => array (
                'field' => 'star_count',
                'title' => '星标数',
                'width' => 120,
            ),
            'is_official' => array (
                'field' => 'is_official',
                'title' => '官方镜像',
                'width' => 100,
            ),
            'description' => array (
                'field' => 'description',
                'title' => '镜像说明',
                'width' => 800,
            ),
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
        $name = $search[1][2] ?? "zhanshop";
        $listData = App::make(Images::class)->search($name, 100);
        return [
            'list' => $listData,
            'total' => count($listData),
        ];
    }

    public function post(Request &$request, Response &$response){
        var_dump($request->post());
    }
}