<?php

namespace app\api\admin\v1\service\finder;

use app\api\admin\v1\service\finder\BaseFinder;
use app\helper\Tools;
use zhanshop\Request;
use zhanshop\Response;

class Image extends BaseFinder
{
    protected $page = [
        'first' => false,
        'last' => false,
        'layout' => []
    ];

    protected $rowToolbar = [
        [
            'event' => 'open',
            'ico' => '&#xe642;',
            'title' => '启动',
            'method' => 'start',
            'condition' => '',
            'page' => './container/start.html',
        ],
        [
            'event' => 'ajax',
            'ico' => '&#xe642;',
            'title' => '推送',
            'method' => 'push',
            'condition' => '',
            'page' => '',
        ],
        [
            'event' => 'delete',
            'ico' => '&#xe642;',
            'title' => '删除',
            'method' => '',
            'condition' => '',
            'page' => '',
        ]
    ];

    protected function getCols(string $schma){
        return [
            'id' => array (
                'field' => 'id',
                'width' => 170,
                'title' => 'ID',
            ),
            'name' => array (
                'field' => 'name',
                'title' => '镜像名称',
                'width' => 220
            ),
            'size' => array (
                'field' => 'size',
                'title' => '大小',
                'width' => 170,
            ),
            'create_time' => array (
                'field' => 'create_time',
                'title' => '创建时间',
                'width' => 170
            )
        ];
    }

    protected function data(int $page, int $limit, array $search){
        $res = Tools::unixHttpRequest(Container::sockFile, Container::sockHost.'/images/json');
        $res = json_decode($res['body'], true);
        $listData = [];
        foreach($res as $v){
            $row = [];
            $row['_id'] = substr(explode(':', $v['Id'])[1], 0, 12);
            $row['name'] = implode(',', $v['RepoTags']);
            $row['create_time'] = date('Y-m-d H:i:s', $v['Created']);
            $row['size'] = round($v['Size'] / 1000 / 1000, 2).'MB';
            $listData[] = $row;
        }
        return [
            'list' => $listData,
            'total' => count($res),
        ];
    }

    public function push(Request &$request, Response &$response){
        Tools::unixHttpRequest(Container::sockFile, Container::sockHost.'/images/'.$request->param('id'), 'DELETE');
        return [];
    }

    public function delete(Request &$request, Response &$response){
        foreach($request->param('pk') as $v){
            Tools::unixHttpRequest(Container::sockFile, Container::sockHost.'/images/'.$v, 'DELETE');
        }
        return [];
    }
}
