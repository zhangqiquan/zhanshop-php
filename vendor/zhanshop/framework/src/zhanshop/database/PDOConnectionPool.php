<?php
// +----------------------------------------------------------------------
// | zhanshop-php / PDOConnectionPool.php    [ 2023/1/31 17:19 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011~2023 zhangqiquan All rights reserved.
// +----------------------------------------------------------------------
// | Author: zhangqiquan <768617998@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace zhanshop\database;
use Swoole\Database\PDOPool;
use zhanshop\database\connection\Mysql;

class PDOConnectionPool
{
    protected $pool;

    protected $drive;

    protected $timeoutPool;

    public function __construct(array $config){
        $type = $config['type'] ?? 'mysql';
        if(strpos($type, '\\') === false) $type = '\\zhanshop\\database\\drive\\'.ucfirst($type);
        $conn = new $type($config);
        $this->drive = $conn;
        $pdoConfig = $conn->PDOConfig();
        $maxConnections = $config['pool']['max_connections'] ?? 20;
        $this->timeoutPool = $config['pool']['timeout'] ?? 0.1;
        $this->pool = new PDOPool($pdoConfig, $maxConnections);
    }

    /**
     * 执行查询
     * @param $pdo
     * @param $sql
     * @return mixed
     */
    protected function _query(mixed $pdo, string $sql, array $bind = []){
        $statement = $pdo->prepare($sql);
        if (!$statement) {
            throw new RuntimeException('Prepare failed');
        }
        $result = $statement->execute($bind);
        if (!$result) {
            throw new RuntimeException('Execute failed');
        }
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }

    /**
     * 执行sql
     * @param $pdo
     * @param $sql
     * @return mixed
     */
    protected function _execute(mixed $pdo, string $sql, array $bind = [], bool $lastID = false){
        $statement = $pdo->prepare($sql);
        if (!$statement) {
            throw new RuntimeException('Prepare failed');
        }
        $result = $statement->execute($bind);
        if (!$result) {
            throw new RuntimeException('Execute failed');
        }
        if($lastID){
            $result = $pdo->lastInsertId();
        }else{
            $result = $statement->rowCount();
        }

        $statement->closeCursor();
        return $result;
    }

    /**
     * 查询
     * @param $sql
     * @param $pdo
     * @return mixed
     * @throws \Exception
     */
    public function query($sql, array $bind = [], $pdo = null){
        if($pdo){
            $result = $this->_query($pdo, $sql, $bind);
        }else{
            $pdo = $this->getPDO();
            try {
                $result = $this->_query($pdo, $sql, $bind);
                $this->recoveryPDO($pdo);
            }catch (Throwable $e){
                $this->recoveryPDO($pdo);
                throw new \Exception($e->getMessage(), $e->getCode());
            }
        }
        return $result;
    }

    /**
     * 事务回调
     * @param $call
     * @return void
     * @throws \Exception
     */
    public function transaction($call){
        $pdo = $this->getPDO();
        $pdo->beginTransaction();
        try {
            $call($pdo);
            $pdo->commit();
            $this->recoveryPDO($pdo);
        }catch (Throwable $e){
            $this->recoveryPDO($pdo);
            $pdo->rollback();
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 执行
     * @param $sql
     * @param array $bind
     * @param bool $lastId
     * @param mixed|null $pdo
     * @return mixed
     * @throws \Exception
     */
    public function execute(string $sql, array $bind = [], bool $lastId = false, mixed $pdo = null){
        if($pdo){
            $result = $this->_execute($pdo, $sql, $bind, $lastId);
        }else{
            $pdo = $this->getPDO();
            try {
                $result = $this->_execute($pdo, $sql, $bind, $lastId);
                $this->recoveryPDO($pdo);
            }catch (Throwable $e){
                $this->recoveryPDO($pdo);
                throw new \Exception($e->getMessage(), $e->getCode());
            }
        }
        return $result;
    }

    /**
     * 获取通道上的pdo
     * @return mixed
     */
    public function getPDO(){
        $pdo = $this->pool->get($this->timeoutPool);
        if($pdo == false){
            throw new \Exception('database连接池耗尽【服务暂时不可用】', 503);
        }
        return $pdo;
    }

    /**
     * 回收pdo至通道
     * @param $pdo
     * @return void
     */
    public function recoveryPDO($pdo){
        $this->pool->put($pdo);
    }

    /**
     * 返回驱动
     * @return Mysql
     */
    public function drive(){
        return $this->drive;
    }
}