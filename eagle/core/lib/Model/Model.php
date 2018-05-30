<?php
namespace core\lib\model;

use core\lib\pdo\Pdo;

class Model {
    protected $table = '';
    protected $connection = '';
    private $pdo = NULL;
    
    private function initPdo(){
        $this->pdo = new Pdo($this->connection);
    }
    
    private function fields($fields = ['*']){
        return implode($fields, ',');
    }
    
    private function where($where = []){
        
        return $this;
    }
    private function groupBy($group = []){
        
        return $this;
    }
    private function orderBy($sort = []){
        
        return $this;
    }
    private function limit($page,$pageSize){
        
        return $this;
    }
    public function getList($where = [],$orWhere = [],$groupBy = [],$orderBy = [],$limit = [],$fields = ['*']){
        if(!$this->pdo){
            $this->initPdo();
        }
        $sql = ' SELECT ' . $this->fields($fields) . ' FROM ' . $this->table . $this->where($where) . $this->where($orWhere)  . $this->where($groupBy) . $this->where($orderBy)  . $this->where($limit)   ;
        return $this->pdo->getAll($sql);
    }
    public function getOne(){
        if(!$this->pdo){
            $this->initPdo();
        }
        $sql = ' SELECT ' . $this->fields . ' FROM ' . $this->table . $this->where ;
        return $this->pdo->getAll($sql);
    }
    
    public function rawSql($sql,$param = []){
        if(!$this->pdo){
            $this->initPdo();
        }
        return $this->pdo->query($sql,$param);
    }
    
    //使用rawSql方法更新，删除时使用
    public function getAffectedCount(){
        return $this->pdo->count();
    }
    
    //使用rawSql方法插入时使用
    public function getlastInsertId(){
        return $this->pdo->lastInsertId();
    }
    
    //使用rawSql方法查询时使用
    public function getResult(){
        return $this->pdo->fetchAll();
    }
}