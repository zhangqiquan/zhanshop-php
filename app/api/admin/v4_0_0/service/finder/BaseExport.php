<?php
// +----------------------------------------------------------------------
// | admin / BaseExport.php    [ 2023/6/14 下午2:52 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v4_0_0\service\finder;

use PHPUnit\Event\Runtime\PHP;
use PHPUnit\PhpParser\Node\Scalar\String_;
use zhanshop\App;
use zhanshop\Csv;
use zhanshop\Request;
use zhanshop\Response;

trait BaseExport
{
    protected $exportResponse = null;
    protected $exportSchma = null;
    protected $exportPK = null;
    protected $exportLastId = 0;

    protected $exportEnablePkRange = false;

    protected function exportFirstRow(){
        $this->exportPK = null;
        $this->exportEnablePkRange = false;
        // 名称为 downloaded.pdf
        //header('Content-Disposition: attachment; filename="'.$this->menuData['title'].'.xls"');

        $this->exportResponse->header('Content-Type', 'text/csv');
        $this->exportResponse->header('Content-Disposition', 'attachment; filename="'.$this->menuData['title'].'.csv"');
        $this->exportSchma = $this->getCols($this->menuData['table_names'][0]);
        $rowTitle = [];
        foreach($this->exportSchma as $k => $v){
            if($this->exportPK == null) $this->exportPK = $v['field'];
            $rowTitle[] = str_replace(',', '，', $v['title']);
        }
        $this->exportResponse->write(implode(',', $rowTitle).PHP_EOL);
        // 如果组件是递增的就启用范围导出
        if(strpos($this->exportPK, 'int')){
            $this->exportEnablePkRange = true;
        }
    }

    protected function exportBodyValHandle(string &$val, array &$field){
        $val = str_replace(',', '，', $val);
        //首先处理时间戳
        if(strpos($field['type'], 'int') !== false){
            if($field['input_type'] == 'time'){
                $val = date('Y-m-d H:i:s', (int)$val);
            }elseif($field['input_type'] == 'date'){
                $val = date('Y-m-d', (int)$val);
            }
        }else if($field['input_type'] == 'timerange'){
            $arr = explode('-', $val);
            $val = date('Y-m-d H:i:d', intval($arr[0])). ' - '.date('Y-m-d H:i:d', intval($arr[1]));
        }

        return $val;
    }

    protected function exportBodyRow(array &$body){
        foreach($body as $k => $v){
            $rowBody = [];
            foreach($this->exportSchma as $kk => $vv){
                $val = (string) $body[$k][$vv['field']];
                $rowBody[] = $this->exportBodyValHandle($val, $vv);
            }
            $this->exportResponse->write(implode(',', $rowBody).PHP_EOL);
            $this->exportLastId = $v[$this->exportPK];
        }
    }

    protected function exportData(int $offset = 0, $limit = 200, array $search = []){
        if(isset($this->menuData['table_names'][0]) == false) App::error()->setError($this->menuData['id'].'的table_names未配置');
        $model = App::database()->model($this->menuData['table_names'][0]);
        if($this->exportEnablePkRange){
            $model = $model->whereRaw($this->exportPK.' > '.$this->exportLastId);
        }
        foreach($search as $v){
            if($v == false || isset($v[0]) == false || isset($v[1]) == false|| isset($v[2]) == false) continue;
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
            $model = $model->order($this->menuData['pk'].' asc');
        }

        return $model->limit($offset, $limit)->select();
    }
    public function exportTable(Request &$request, Response &$response){

        $this->exportResponse = $response;

        $this->exportFirstRow();

        $search = $request->post('search', []);

        $page = 0;
        $limit = 200;
        while (true){
            $offset = $page * $limit;
            $data = $this->exportData($offset, $limit, $search);
            if($data == false){
                break;
            }
            $this->exportBodyRow($data);
            $page++;

        }
    }
}