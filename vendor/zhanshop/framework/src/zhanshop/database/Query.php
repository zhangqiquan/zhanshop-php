<?php
// +----------------------------------------------------------------------
// | zhanshop-php / Query.php    [ 2023/1/31 17:09 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace zhanshop\database;

use zhanshop\App;

class Query
{
    protected string $connection;

    protected mixed $builder;

    protected $options = [];

    protected $bind = [];

    public function __construct(string $connection, string $builder){
        $this->connection = $connection;
        if(strpos($builder, '\\') === false) $builder = '\\zhanshop\\database\\builder\\'.ucfirst($builder);
        $this->builder = new $builder;
    }

    public function table(string $table){
        $this->options['table'] = $table;
        return $this;
    }

    public function alias(string $alias){
        $this->options['alias'] = $alias;
        return $this;
    }

    public function buildSql(){
        return '('.$this->builder->buildSql($this).')';
    }

    public function fetchSql(string $field = "*"){
        $this->options['field'] = $field;
        return $this->builder->buildSql($this);
    }

    /**
     * @param string $table
     * @return void
     */
    public function join(string $table, $alias, string $condition, string $type = 'INNER', array $bind = []){
        $this->options['join'][] = [
            'table' => $table,
            'alias' => $alias,
            'condition' => $condition,
            'type' => $type,
            'bind' => $bind
        ];
        return $this;
    }

    public function leftJoin(string $table, $alias, string $condition, array $bind = []){
        $this->options['join'][] = [
            'table' => $table,
            'alias' => $alias,
            'condition' => $condition,
            'type' => 'LEFT',
            'bind' => $bind
        ];
        return $this;
    }

    public function rightJoin(string $table, $alias, string $condition, array $bind = []){
        $this->options['join'][] = [
            'table' => $table,
            'alias' => $alias,
            'condition' => $condition,
            'type' => 'RIGHT',
            'bind' => $bind
        ];
        return $this;
    }

    public function fullJoin(string $table, $alias, string $condition, array $bind = []){
        $this->options['join'][] = [
            'table' => $table,
            'alias' => $alias,
            'condition' => $condition,
            'type' => 'FULL',
            'bind' => $bind
        ];
        return $this;
    }

    public function field(string $field = "*"){
        $this->options['field'] = $field;
        return $this;
    }

    public function distinct(bool $distinct){
        $this->options['distinct'] = $distinct;
        return $this;
    }
    public function group(string $group){
        $this->options['group'] = $group;
        return $this;
    }

    public function order(string $order){
        $this->options['order'][] = $order;
        return $this;
    }

    public function limit(int $offset, ?int $length = null){
        $this->options['limit'] = [$offset, $length];
        return $this;
    }

    public function having(string $condition, array $bind = []){
        $this->options['having'][] = [$condition, $bind];
        return $this;
    }

    public function where(array $condition){
        $this->options['where']['AND'] = array_merge($this->options['where']['AND'] ?? [], $condition);
        return $this;
    }

    public function whereIn(string $key, array $array){
        $this->options['where']['In'][$key] = $array;
        return $this;
    }

    public function whereNotIn(string $key, array $array){
        $this->options['where']['NotIn'][$key] = $array;
        return $this;
    }

    public function whereRaw(string $condition, array $bind = []){
        if($condition) $this->options['where']['RAW'][] = [$condition, $bind];
        return $this;
    }

    public function insert(array $data, mixed $pdo = null) :float{
        if (!empty($data)) {
            $this->options['data'][] = $data;
            $sql = $this->builder->insert($this);
            return $this->execute($sql, $this->getBind(), false, $pdo);
        }
        return 0;
    }

    public function insertGetId(array $data, mixed $pdo = null) :float{
        if (!empty($data)) {
            $this->options['data'][] = $data;
            $sql = $this->builder->insert($this);
            return $this->execute($sql, $this->getBind(), true, $pdo);
        }
        return 0;
    }

    public function update(array $data, mixed $pdo = null){
        if (!empty($data)) {
            $this->options['data'][] = $data;
            $sql = $this->builder->update($this);
            return $this->execute($sql, $this->getBind(), false, $pdo);
        }
    }

    public function delete(mixed $pdo = null){
        $sql = $this->builder->delete($this);
        return $this->execute($sql, $this->getBind(), false, $pdo);
    }

    public function insertAll(array $data, bool $getLastInsID = false, mixed $pdo = null) :float{
        if (!empty($data)) {
            $this->options['data'] = $data;
            $sql = $this->builder->insert($this);
            return $this->execute($sql, $this->getBind(), $getLastInsID, $pdo);
        }
        return 0;
    }

    public function count(string $field = '*', mixed $pdo = null){
        $this->options['field'] = $field;
        $sql = $this->builder->count($this);
        $data = $this->query($sql, $this->getBind(), $pdo);
        return $data[0]['__count'] ?? 0;
    }

    public function avg(string $field, mixed $pdo = null){
        $this->options['field'] = $field;
        $sql = $this->builder->avg($this);
        $data = $this->query($sql, $this->getBind(), $pdo);
        return $data[0]['__avg'] ?? 0;
    }

    public function max(string $field, mixed $pdo = null){
        $this->options['field'] = $field;
        $sql = $this->builder->max($this);
        $data = $this->query($sql, $this->getBind(), $pdo);
        return $data[0]['__max'] ?? 0;
    }

    public function min(string $field, mixed $pdo = null){
        $this->options['field'] = $field;
        $sql = $this->builder->min($this);
        $data = $this->query($sql, $this->getBind(), $pdo);
        return $data[0]['__min'] ?? 0;
    }

    public function sum(string $field = '*', mixed $pdo = null){
        $this->options['field'] = $field;
        $sql = $this->builder->sum($this);
        $data = $this->query($sql, $this->getBind(), $pdo);
        return $data[0]['__sum'] ?? 0;
    }

    public function find(mixed $pdo = null){
        $sql = $this->builder->find($this);
        $data = $this->query($sql, $this->getBind(), $pdo);
        return $data[0] ?? null;
    }

    public function select(mixed $pdo = null){
        $sql = $this->builder->select($this);
        $data = $this->query($sql, $this->getBind(), $pdo);
        return $data;
    }

    public function finder(int $page, int $limit = 20, mixed $pdo = null){
        $offset = ($page - 1) * $limit;
        return [
            'data' => $this->limit($offset, $limit)->select($pdo),
            'total' => $this->count('*', $pdo),
        ];
    }

    public function value(string $field, mixed $pdo = null){
        $this->options['field'] = $field;
        $sql = $this->builder->find($this);
        $data = $this->query($sql, $this->getBind(), $pdo);
        return $data[0][$field] ?? null;
    }

    public function column(string $field, string $key, mixed $pdo = null){
        $ret = [];
        $data = $this->field($key.','.$field)->select($pdo);
        if($data){
            if(strpos($field, ',') === false){
                foreach($data as $v){
                    $ret[$v[$key]] = $v[$field];
                }
            }else{
                foreach($data as $v){
                    $ret[$v[$key]] = $v;
                }
            }
        }
        return $ret;
    }


    public function query(string $sql, array $bind = [], mixed $pdo = null){
        $pdoPoll = DbManager::get($this->connection);
        return $pdoPoll->query($sql, $bind, $pdo);
    }

    public function execute(string $sql, array $bind = [], bool $lastID = false, mixed $pdo = null){
        $pdoPoll = DbManager::get($this->connection);
        return (float) $pdoPoll->execute($sql, $bind, $lastID, $pdo);
    }

    public function transaction($call){
        $pdoPoll = DbManager::get($this->connection);
        $pdoPoll->transaction($call);
    }

    /**
     * 获取当前的查询参数
     * @access public
     * @param string $name 参数名
     * @return mixed
     */
    public function &getOptions(string $name = '', bool $setNull = false)
    {
        if ('' === $name) {
            return $this->options;
        }

        $data = $this->options[$name] ?? null;
        //if($setNull) unset($this->options[$name]);
        return $data;
    }

    /**
     * 绑定的参数
     * @param array $bind
     * @return void
     */
    public function setBind(string $key, mixed $value){
        $this->bind[$key] = $value;
    }

    public function setBindArray(array $array){
        $this->bind = array_merge($this->bind, $array);
    }

    public function &getBind(){
        $bind =  $this->bind;
        $this->bind = [];
        return $bind;
    }
}