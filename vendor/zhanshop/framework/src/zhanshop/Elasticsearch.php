<?php

namespace zhanshop;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class Elasticsearch
{
    protected $baseUrl = "";
    protected $userPwd = "";
    protected $options = [];
    public function __construct()
    {
        // http://elastic:zhangqiquan123@127.0.0.1:9200/_cat/indices
        $connection = App::config()->get('elasticsearch.connection');
        $auth = '';
        if($connection['user'] && $connection['pass']){
            $this->userPwd = $connection['user'].':'.$connection['pass'];
        }
        $this->baseUrl = $connection['scheme'].'://'.$connection['host'][0].':'.$connection['port'];
    }

    /**
     * 获取所有表
     * @return string[]
     */
    public function showTables(){
        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        $ret = $curl->request($this->baseUrl.'/_cat/indices?v');
        $arr = explode("\n", $ret['body']);
        unset($arr[0]);
        return array_values($arr);
    }

    /**
     * 显示状态
     * @return string[]
     */
    public function showStatus(){
        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        $ret = $curl->request($this->baseUrl.'/_cat/health?v');
        $arr = explode("\n", $ret['body']);
        unset($arr[0]);
        return array_values($arr);
    }

    /**
     * 清空数据表
     * @return void
     */
    public function truncate(){
        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        try {
            $curl->request($this->baseUrl.'/'.$this->options['index'], 'DELETE');
            return true;
        }catch (\Throwable $e){
            return false;
        }
    }

    public function indexName(string $name){
        $this->options['index'] = $name;
        return $this;
    }

    /**
     * 创建索引
     * @param array $data
     * @return void
     */
    public function createIndex(array $data){
        /**
         * {
        "settings": {
        "number_of_shards": 3,
        "number_of_replicas": 2
        },
        "mapping": {
        "_doc": {
        "properties": {
        "commodity_id": {
        "type": "long"
        },
        "commodity_name": {
        "type": "text"
        },
        "picture_url": {
        "type": "keyword"
        },
        "price": {
        "type": "double"
        }
        }
        }
        }
        }



        {
        "doctor": {
        "aliases": {},
        "mappings": {
        "properties": {
        "id": {
        "type": "long"
        },
        "name": {
        "type": "text",
        "fields": {
        "keyword": {
        "type": "keyword",
        "ignore_above": 256
        }
        }
        },
        "proficient": {
        "type": "text",
        "fields": {
        "keyword": {
        "type": "keyword",
        "ignore_above": 256
        }
        }
        }
        }
        },
        "settings": {
        "index": {
        "routing": {
        "allocation": {
        "include": {
        "_tier_preference": "data_content"
        }
        }
        },
        "number_of_shards": "1",
        "provided_name": "doctor",
        "creation_date": "1697448853800",
        "number_of_replicas": "1",
        "uuid": "fqhMEfJDS6eiLjBFt4Y5DA",
        "version": {
        "created": "8080199"
        }
        }
        }
        }
        }

         */


        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        $ret = $curl->request($this->baseUrl.'/'.$this->options['index'], 'PUT', $data);
        return json_decode($ret['body'], true);
    }

    /**
     * 插入单条
     * @param $data
     * @return void
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\MissingParameterException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     */
    public function insert(array $data, string $id = ""){
        if($id == false) $id = Helper::orderId();
        $this->options['id'] = $id;
        $this->options['body'] = $data;

        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        $ret = $curl->request($this->baseUrl.'/'.$this->options['index'].'/_doc/'.$id.'?pretty', 'POST', $data);
        return json_decode($ret['body'], true);
    }

    /**
     * 插入多条
     * @param array $data
     * @return array
     */
    public function insertAll(array $data, array $ids = []){
        $saveAll = "";
        foreach($data as $k => $v){
            $orderId = $ids[$k] ?? Helper::orderId((string)$k);
            $save = [
                'index' => [
                    '_index' => $this->options['index'],
                    '_type' => '_doc',
                    '_id' => $orderId
                ],
            ];
            $saveAll .= json_encode($save)."\n";
            $saveAll .= json_encode($v)."\n";
        }
        $saveAll .= "\r\n";
        $this->options = [];
        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        $ret = $curl->request($this->baseUrl.'/_bulk', 'POST', $saveAll, 'POST');
        return json_decode($ret['body'], true);
    }

    /**
     * 原始查询
     * @param array $arr
     * @return $this
     */
    public function whereRaw(array $arr){
        $this->options['whereRaw'][] = $arr;
        return $this;
    }

    /**
     * 条件
     * @param array $data
     * @return $this
     */
    public function where(string $field, string $condition, mixed $value){
        $this->options['where'][] = [$field, $condition, $value];
        return $this;
    }

    /**
     * 或条件
     * @param string $field
     * @param string $condition
     * @param mixed $value
     * @return $this
     */
    public function whereOr(string $field, string $condition, mixed $value){
        $this->options['whereOr'][] = [$field, $condition, $value];
        return $this;
    }

    /**
     * 仅返回指定字段
     * @param string $field
     * @return $this
     */
    public function field(string $field){
        $this->options['field'] = $field;
        return $this;
    }
    /**
     * 排序值
     * @param string $order
     * @return $this
     */
    public function order(string $order){
        $this->options['order'][] = $order;
        return $this;
    }

    protected function getRawParam(array &$params){
        if(isset($this->options['whereRaw'])){
            foreach ($this->options['whereRaw'] as $v){
                $params = array_merge($params, $v);
            }

        }
    }
    /**
     * 请求参数组合AND
     * @return array
     */
    protected function getQueryAndParam(array &$params){
        if(isset($this->options['where'])){
            foreach($this->options['where'] as $v){
                if($v[1] == 'like'){
                    $field = is_int($v[2]) ?  $v[0] : $v[0].'.keyword';
                    $params['bool']['must'][] = [
                        'wildcard' => [$field => '*'.$v[2].'*']
                    ];
                }else if($v[1] == '='){
                    $field = is_int($v[2]) ?  $v[0] : $v[0].'.keyword';
                    $params['bool']['must'][]['term'][$field] = $v[2];
                }else if($v[1] == 'in'){
                    $field = is_int($v[2][0]) ?  $v[0] : $v[0].'.keyword';
                    $params['bool']['must'][]['terms'][$field] = $v[2];
                }else if($v[1] == '!='){
                    $field = is_int($v[2]) ?  $v[0] : $v[0].'.keyword';
                    $params['bool']['must_not'][]['terms'][$field] = $v[2];
                }else if($v[1] == 'not in'){
                    $field = is_int($v[2][0]) ?  $v[0] : $v[0].'.keyword';
                    $params['bool']['must_not'][]['terms'][$field] = $v[2];
                }else{
                    // 大于等于 小于等于 不等于 range
                    $arr = [">=" => 'gte', '>' => 'gt', '<=' => 'lte', '<' => 'lt'];
                    $params['bool']['must'][]['range'][$v[0]][$arr[$v[1]] ?? App::error()->setError($v[1].'不支持的操作符')] = $v[2];
                }
            }
        }
    }

    /**
     * 请求参数组合OR
     * @return array
     */
    protected function getQueryORParam(array &$params){
        if(isset($this->options['whereOr'])){
            foreach($this->options['whereOr'] as $v){
                if($v[1] == 'like'){
                    $field = is_int($v[2]) ?  $v[0] : $v[0].'.keyword';
                    $params['bool']['should'][] = [
                        'wildcard' => [$field => '*'.$v[2].'*']
                    ];
                }else if($v[1] == '='){
                    $field = is_int($v[2]) ?  $v[0] : $v[0].'.keyword';
                    $params['bool']['should'][]['term'][$field] = $v[2];
                }else if($v[1] == 'in'){
                    $field = is_int($v[2][0]) ?  $v[0] : $v[0].'.keyword';
                    $params['bool']['should'][]['terms'][$field] = $v[2];
                }else{
                    // 大于等于 小于等于 不等于 range
                    $arr = [">=" => 'gte', '>' => 'gt', '<=' => 'lte', '<' => 'lt'];
                    $params['bool']['should'][]['range'][$v[0]][$arr[$v[1]] ?? App::error()->setError($v[1].'不支持的操作符')] = $v[2];
                }
            }
        }
    }

    /**
     * 获取排序参数
     * @return array
     */
    protected function getOrderParam(array &$params){
        if(isset($this->options['order'])){
            foreach($this->options['order'] as $v){
                $arr = explode(' ', $v);
                $params['sort'][$arr[0]] = ['order' => $arr[1]];
            }
        }
    }

    /**
     * 分页查询
     * @param int $page
     * @param in $limit
     * @return array
     */
    public function finder(int $page = 1, int $limit = 20){
        $url = $this->baseUrl.'/'.$this->options['index'].'/_search';
        $offset = ($page - 1) * $limit;
        $page--;
        // 字符串字段不支持排序
        $params = ['query' => []];
        $params['from'] = $page;
        $params['size'] = $limit;

        $this->getQueryAndParam($params['query']);

        $this->getQueryORParam($params['query']);

        $this->getRawParam($params['query']);

        $this->getOrderParam($params);

        if(isset($this->options['field'])) $params['_source'] = explode(',', $this->options['field']);

        if($params['query'] == false) unset($params['query']);

        $this->options = [];
        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        $data = [
            'total' => 0,
            'list' => [],
            'max_score' => 0,
            'errmsg' => '',
            'original' => [],
        ];
        try {
            $ret = $curl->request($url, 'POST', $params);
            $resp = json_decode($ret['body'], true);
            $data['total'] = $resp['hits']['total'];
            $data['max_score'] = $resp['hits']['max_score'];
            $data['list'] = $resp['hits']['hits'];
            unset($resp['hits']);
            $data['original'] = $resp;
        }catch (\Throwable $e){
            $data['errmsg'] = $e->getMessage();
        }
        return $data;
    }

    /**
     * 执行sql
     * @param string $sql
     * @return array
     */
    public function query(string $sql){
        //POST /_sql?format=txt
        $url = $this->baseUrl.'/_sql?format=json';
        // 字符串字段不支持排序
        $params = ['query' => $sql];
        $this->options = [];
        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        $ret = $curl->request($url, 'POST', $params);
        $ret = json_decode($ret['body'], true);
        $data = [];
        foreach($ret['rows'] as $vals){
            $row = [];
            foreach($vals as $k => $v){
                $row[$ret['columns'][$k]['name']] = $v;
            }
            $data[] = $row;
        }
        return $data;
    }

    /**
     * 查询并删除
     * @return array
     */
    public function delete(){
        $url = $this->baseUrl.'/'.$this->options['index'].'/_delete_by_query';
        $params = ['query' => []];

        $this->getQueryAndParam($params['query']);

        $this->getQueryORParam($params['query']);

        if($params['query'] == false) unset($params['query']);

        $this->options = [];
        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        $ret = $curl->request($url, 'POST', $params);
        return json_decode($ret['body'], true);
    }

    /**
     * 查询并更新
     * @return array
     */
    public function update(array $data){
        $url = $this->baseUrl.'/'.$this->options['index'].'/_update_by_query?conflicts=proceed&wait_for_completion=false';
        $params = ['query' => []];

        $this->getQueryAndParam($params['query']);

        $this->getQueryORParam($params['query']);

        if($params['query'] == false) unset($params['query']);

        $source = "";
        foreach($data as $k => $v){
            if(is_int($k)){
                $source .= 'ctx._source.'.$v.';';
            }else{
                $source .= "ctx._source.{$k} = '".$v."';";
            }
        }
        $source = rtrim($source, ';');

        $params['script'] = [
            'source' => $source,
            'lang' => 'painless',
        ];

        $this->options = [];
        $curl = new Curl();
        if($this->userPwd) $curl->setopt(CURLOPT_USERPWD, $this->userPwd);
        $curl->setHeader('Content-Type', 'application/json');
        $ret = $curl->request($url, 'POST', $params);
        return json_decode($ret['body'], true);
    }

}