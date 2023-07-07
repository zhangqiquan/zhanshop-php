<?php

namespace app\api\admin\v4_0_0\service\finder;

use app\api\admin\v4_0_0\service\finder\BaseFinder;
use zhanshop\Request;
use zhanshop\Response;

class WebConfig extends BaseFinder
{
    public function editfromconfig(Request &$request, Response &$response)
    {
        $data = [
            [
                'title' => '站点参数',
                'table_name' => '',
                'schema' => [
                    $this->getInputFrom('website_title', '网站名称', 'input', true),
                    $this->getInputFrom('website_keyword', '网站关键字', 'textarea', true),
                    $this->getInputFrom('website_description', '网站描述', 'textarea', true),
                    $this->getInputFrom('website_filing', '备案信息', 'input', true),
                    $this->getInputFrom('website_filing', '版权信息', 'input', true),
                ],
            ],
        ];
        return $data;
    }
}