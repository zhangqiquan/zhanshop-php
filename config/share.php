<?php
// +----------------------------------------------------------------------
// | zhanshop-docker-server / memorytable.php    [ 2023/12/5 20:57 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);
return [
    'capacity' => 0,
    'field' => [
        [
            'name' => 'ip',
            'type' => 'string',
            'length' => 255
        ],
        [
            'name' => 'fd',
            'type' => 'int',
            'length' => 11
        ],
        [
            'name' => 'free',
            'type' => 'int',
            'length' => 11
        ],
    ],
];