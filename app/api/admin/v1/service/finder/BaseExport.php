<?php
// +----------------------------------------------------------------------
// | admin / BaseExport.php    [ 2023/6/14 下午2:52 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace app\api\admin\v1\service\finder;

use zhanshop\App;
use zhanshop\Export;
use zhanshop\export\Xls;
use zhanshop\Request;
use zhanshop\Response;

trait BaseExport
{
    protected $exportLastId = 0;
    protected array $colsField;

    /**
     * 表头数据
     * @return array
     * @throws \Exception
     */
    protected function headExportData(){
        $colsField = $this->getCols($this->menuData['table_names'][0]);
        $this->colsFirst = $colsField;
        $topCol = [];
        foreach($colsField as $k => $v){
            $topCol[] = [
                'style' => 'bold',
                'type' => 'string',
                'width' => $v['width'],
                'value' => $v['title'] ?? $v['field'],
            ];
        }
        return $topCol;
    }

    protected function fieldValHandle(string &$val, array &$field){
        //首先处理时间戳
        if(strpos($field['type'], 'int') !== false){
            if($field['input_type'] == 'time'){
                $val = date('Y-m-d H:i:s', (int)$val);
            }elseif($field['input_type'] == 'date'){
                $val = date('Y-m-d', (int)$val);
            }
        }else if($field['input_type'] == 'timerange'){
            $arr = explode(',', str_replace(' ', '', $val));
            if(count($arr) == 2){
                $val = date('Y-m-d H:i:d', intval($arr[0])). ' - '.date('Y-m-d H:i:d', intval($arr[1]));
            }
        }

        return $val;
    }

    /**
     * 行数据
     * @param Response $response
     * @param array $listData
     * @return void
     * @throws \Exception
     */
    protected function rowExport(array &$data){
        $rowData = [];
        foreach($this->colsField as $vv){
            $val = (string) $data[$vv['field']] ?? "";
            $rowData[] = [
                'style' => 'default',
                'type' => 'string',
                'value' => $this->fieldValHandle($val, $vv),
            ];
        }
        return $rowData;
    }

    /**
     * 获取数据列表
     * @param float $maxId
     * @param $limit
     * @param array $search
     * @return mixed
     * @throws \Exception
     */
    protected function getListData(float $maxId, $limit = 200, array $search = []){
        if(isset($this->menuData['table_names'][0]) == false) App::error()->setError($this->menuData['id'].'的table_names未配置');
        $model = App::database()->model($this->menuData['table_names'][0])->whereRaw($this->menuData['pk'].' > '.$maxId);
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

        return $model->limit(0, $limit)->select();
    }

    /**
     * 导出表格
     * @param Request $request
     * @param Response $response
     * @return void
     * @throws \Exception
     */
    public function export(Request &$request, Response &$response){
        $this->colsField = $this->getCols($this->menuData['table_names'][0]);
        $response->header('Content-Type', 'application/vnd.ms-excel');
        $response->header('Content-Disposition', 'attachment; filename="'.$this->menuData['title'].'.xls"');
        $xlsCode = "";
        $export = new Export();
        $xlsCode .= $export->Workbook(); // 创建工作博

        $xlsCode .= $export->styles(); // 默认样式

        $response->write($xlsCode);


        $worksheet = $export->worksheet(); // 创建一张工作表

        $xlsCode = "";
        $xlsCode .= $worksheet->title($this->menuData['title']);// 设置工作表名称

        $xlsCode .= $worksheet->header($this->headExportData());// 设置表头
        $response->write($xlsCode);

        $search = $request->post('search', []);

        $maxId = 0;
        $limit = 200;
        while (true){
            $data = $this->getListData($maxId, $limit, $search);
            if($data == false){
                break;
            }
            foreach($data as $v){
                $rowData = $this->rowExport($v);
                //var_dump($rowData);
                $response->write($worksheet->row($rowData));
                $maxId = $v[$this->menuData['pk']];
            }

        }
        $xlsCode = $worksheet->end();
        $xlsCode .= $export->end();
        $response->write($xlsCode);
    }
}