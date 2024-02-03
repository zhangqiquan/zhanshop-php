<?php
// +----------------------------------------------------------------------
// | zhanshop-server / Deviceonline.php    [ 2023/12/15 16:22 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\finder;

use zhanshop\console\ServerStatus;
use zhanshop\ShareData;

class Deviceonline extends BaseFinder
{
    protected $rowToolbar = [
        [
            'event' => 'open',
            'ico' => '&#xe642;',
            'title' => '连接到终端',
            'method' => '',
            'condition' => '',
            'page' => './page/device/openssh.html',
        ],
        [
            'event' => 'open',
            'ico' => '&#xe642;',
            'title' => '执行函数',
            'method' => '',
            'condition' => '',
            'page' => './page/device/function.html'
        ],
    ];

    protected function getCols(string $schma){
        $this->menuData['pk'] = 'fd';
        return [
            'fd' => array (
                'field' => 'fd',
                'title' => 'ID',
                'type' => 'text',
                'width' => 180,
            ),
            'name' => array (
                'field' => 'name',
                'title' => '设备名称',
                'type' => 'text',
                'width' => 220,
            ),
            'ip' => array (
                'field' => 'ip',
                'title' => '设备IP',
                'type' => 'text',
                'width' => 220,
            ),
            'online_time' => array (
                'field' => 'online_time',
                'title' => '在线时长',
                'type' => 'text',
                'width' => 170,
            )
        ];
    }

    protected function data(int $page, int $limit, array $search){
        $count = 0;
        $list = [];
        $time = time();
        foreach (ShareData::getInstance() as $row){
            $row['online_time'] = ServerStatus::getTimeStr($time - $row['connect_time']);
            $list[] = $row;
            $count++;
            if($count > 1000) break;
        }
        return [
            'list' => $list,
            'total' => count($list),
        ];
    }
}