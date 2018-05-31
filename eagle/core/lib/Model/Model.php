<?php

namespace core\lib\model;

use core\lib\pdo\Pdo;

class Model {
    private $pdoConnect = NULL;
    private $prepareParam = [];
    private function connectPdo() {
        $this->pdoConnect = new Pdo($this->connection);
    }
    private function fields($fields = ['*']) {
        return implode($fields, ',');
    }
    private function where($where = []) {
        $whereStr = ' 1=1 ';
        if(is_array($where)){
            foreach($where as $val){
                if($val[1] === '='){
                    $whereStr .= " AND `{$val[0]}` = ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '='){
                    $whereStr .= " AND `{$val[0]}` = ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '!='){
                    $whereStr .= " AND `{$val[0]}` != ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '>'){
                    $whereStr .= " AND `{$val[0]}` > ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '<'){
                    $whereStr .= " AND `{$val[0]}` < ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '>='){
                    $whereStr .= " AND `{$val[0]}` >= ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '<='){
                    $whereStr .= " AND `{$val[0]}` <= ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '<>'){
                    $whereStr .= " AND `{$val[0]}` <> ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif(strtoupper($val[1]) === 'IN'){
                    $inStr = ' ( ';
                    foreach($val[2] as $k => $v){
                        $inStr .= '?,';
                        array_push($this->prepareParam, $v);
                    }
                    unset($v);
                    $inStr = rtrim($inStr, ',');
                    $inStr .= ' ) ';
                    $whereStr .= " AND `{$val[0]}` IN {$inStr} ";
                }elseif(strtoupper($val[1]) === 'NOT IN'){
                    $notinStr = ' ( ';
                    foreach($val[2] as $k => $v){
                        $notinStr .= '?,';
                        array_push($this->prepareParam, $v);
                    }
                    unset($v);
                    $notinStr = rtrim($notinStr, ',');
                    $notinStr .= ' ) ';
                    $whereStr .= " AND `{$val[0]}` NOT IN {$notinStr} ";
                }elseif(strtoupper($val[1]) === 'BETWEEN AND'){
                    $whereStr .= " AND `{$val[0]}` BETWEEN ? AND ? ";
                    array_push($this->prepareParam, $val[2][0]);
                    array_push($this->prepareParam, $val[2][1]);
                }elseif(strtoupper($val[1]) === 'NOT BETWEEN AND'){
                    $whereStr .= " AND `{$val[0]}` NOT BETWEEN ? AND ? ";
                    array_push($this->prepareParam, $val[2][0]);
                    array_push($this->prepareParam, $val[2][1]);
                }elseif(strtoupper($val[1]) === 'LIKE'){
                    $whereStr .= " AND `{$val[0]}` LIKE ? ";
                    array_push($this->prepareParam, "%{$val[2]}%");
                }elseif(strtoupper($val[1]) === 'BEFORE LIKE'){
                    $whereStr .= " AND `{$val[0]}` LIKE ? ";
                    array_push($this->prepareParam, "{$val[2]}%");
                }elseif(strtoupper($val[1]) === 'AFTER LIKE'){
                    $whereStr .= " AND `{$val[0]}` LIKE ? ";
                    array_push($this->prepareParam, "%{$val[2]}");
                }elseif(strtoupper($val[1]) === 'NOT LIKE'){
                    $whereStr .= " AND `{$val[0]}` NOT LIKE ? ";
                    array_push($this->prepareParam, "%{$val[2]}%");
                }elseif(strtoupper($val[1]) === 'BEFORE NOT LIKE'){
                    $whereStr .= " AND `{$val[0]}` NOT LIKE ? ";
                    array_push($this->prepareParam, "{$val[2]}%");
                }elseif(strtoupper($val[1]) === 'AFTER NOT LIKE'){
                    $whereStr .= " AND `{$val[0]}` NOT LIKE ? ";
                    array_push($this->prepareParam, "%{$val[2]}");
                }elseif(strtoupper($val[1]) === 'IS NULL'){
                    $whereStr .= " AND `{$val[0]}` IS NULL ";
                }elseif(strtoupper($val[1]) === 'IS NOT NULL'){
                    $whereStr .= " AND `{$val[0]}` IS NOT NULL ";
                }elseif(strtoupper($val[1]) === 'CUSTOM'){
                    $whereStr .= " AND {$val[2]} ";
                }else{
                    $whereStr .= " AND `{$val[0]}` = ? ";
                    array_push($this->prepareParam, $val[2]);
                }
            }
        }
        return $whereStr;
    }
    private function orWhere($orWhere = []) {
        $orWhereStr = ' AND 1=1 ';
        if(is_array($orWhere)){
            foreach($orWhere as $val){
                if($val[1] === '='){
                    $orWhereStr .= " OR `{$val[0]}` = ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '='){
                    $orWhereStr .= " OR `{$val[0]}` = ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '!='){
                    $orWhereStr .= " OR `{$val[0]}` != ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '>'){
                    $orWhereStr .= " OR `{$val[0]}` > ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '<'){
                    $orWhereStr .= " OR `{$val[0]}` < ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '>='){
                    $orWhereStr .= " OR `{$val[0]}` >= ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '<='){
                    $orWhereStr .= " OR `{$val[0]}` <= ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif($val[1] === '<>'){
                    $orWhereStr .= " OR `{$val[0]}` <> ? ";
                    array_push($this->prepareParam, $val[2]);
                }elseif(strtoupper($val[1]) === 'IN'){
                    $inStr = ' ( ';
                    foreach($val[2] as $k => $v){
                        $inStr .= '?,';
                        array_push($this->prepareParam, $v);
                    }
                    unset($v);
                    $inStr = rtrim($inStr, ',');
                    $inStr .= ' ) ';
                    $orWhereStr .= " OR `{$val[0]}` IN {$inStr} ";
                }elseif(strtoupper($val[1]) === 'NOT IN'){
                    $notinStr = ' ( ';
                    foreach($val[2] as $k => $v){
                        $notinStr .= '?,';
                        array_push($this->prepareParam, $v);
                    }
                    unset($v);
                    $notinStr = rtrim($notinStr, ',');
                    $notinStr .= ' ) ';
                    $orWhereStr .= " OR `{$val[0]}` NOT IN {$notinStr} ";
                }elseif(strtoupper($val[1]) === 'BETWEEN AND'){
                    $orWhereStr .= " OR `{$val[0]}` BETWEEN ? AND ? ";
                    array_push($this->prepareParam, $val[2][0]);
                    array_push($this->prepareParam, $val[2][1]);
                }elseif(strtoupper($val[1]) === 'NOT BETWEEN AND'){
                    $orWhereStr .= " OR `{$val[0]}` NOT BETWEEN ? AND ? ";
                    array_push($this->prepareParam, $val[2][0]);
                    array_push($this->prepareParam, $val[2][1]);
                }elseif(strtoupper($val[1]) === 'LIKE'){
                    $orWhereStr .= " OR `{$val[0]}` LIKE ? ";
                    array_push($this->prepareParam, "%{$val[2]}%");
                }elseif(strtoupper($val[1]) === 'BEFORE LIKE'){
                    $orWhereStr .= " OR `{$val[0]}` LIKE ? ";
                    array_push($this->prepareParam, "{$val[2]}%");
                }elseif(strtoupper($val[1]) === 'AFTER LIKE'){
                    $orWhereStr .= " OR `{$val[0]}` LIKE ? ";
                    array_push($this->prepareParam, "%{$val[2]}");
                }elseif(strtoupper($val[1]) === 'NOT LIKE'){
                    $orWhereStr .= " OR `{$val[0]}` NOT LIKE ? ";
                    array_push($this->prepareParam, "%{$val[2]}%");
                }elseif(strtoupper($val[1]) === 'BEFORE NOT LIKE'){
                    $orWhereStr .= " OR `{$val[0]}` NOT LIKE ? ";
                    array_push($this->prepareParam, "{$val[2]}%");
                }elseif(strtoupper($val[1]) === 'AFTER NOT LIKE'){
                    $orWhereStr .= " OR `{$val[0]}` NOT LIKE ? ";
                    array_push($this->prepareParam, "%{$val[2]}");
                }elseif(strtoupper($val[1]) === 'IS NULL'){
                    $orWhereStr .= " OR `{$val[0]}` IS NULL ";
                }elseif(strtoupper($val[1]) === 'IS NOT NULL'){
                    $orWhereStr .= " OR `{$val[0]}` IS NOT NULL ";
                }elseif(strtoupper($val[1]) === 'CUSTOM'){
                    $orWhereStr .= " OR {$val[2]} ";
                }else{
                    $orWhereStr .= " OR `{$val[0]}` = ? ";
                    array_push($this->prepareParam, $val[2]);
                }
            }
        }
        return $orWhereStr;
    }
    private function groupBy($group = []) {
        if($group && $group){
            return ' GROUP BY ' . implode($group, ',') . ' ';
        }
        return '';
    }
    private function orderBy($orderBy = []) {
        if($orderBy && $orderBy){
            $orderByStr = ' ORDER BY ';
            foreach($orderBy as $field => $sort){
                $sort = strtoupper($sort);
                $orderByStr .= " `{$field}` {$sort},";
            }
            return rtrim($orderByStr, ',') . ' ';
        }
        return '';
    }
    private function limit($limit = [0,0]) {
        if((int)$limit[0] <= 0 || (int)$limit[1] <= 0){
            return '';
        }
        $offset = ($limit[0] - 1) * $limit[1];
        return " LIMIT {$offset},{$limit[1]}  ";
    }
    private function prepareUpdateData($updateData) {
        if(!$updateData || !is_array($updateData)){
            return '';
        }
        $updateDataStr = '';
        foreach($updateData as $k => $v){
            array_push($this->prepareParam, $v);
            $updateDataStr .= " $k=?, ";
        }
        return rtrim($updateDataStr, ',');
    }
    public function rawSql($sql, $param = []) {
        if(!$this->pdoConnect){
            $this->connectPdo();
        }
        return $this->pdoConnect->execute($sql, $param);
    }
    public function getMore($where = [], $orWhere = [], $groupBy = [], $orderBy = [], $limit = [0,0], $fields = ['*']) {
        if(!$this->pdoConnect){
            $this->connectPdo();
        }
        $sql = ' SELECT ' . $this->fields($fields) . ' FROM ' . $this->table . ' WHERE ' . $this->where($where) . $this->orWhere($orWhere) . $this->groupBy($groupBy) . $this->orderBy($orderBy) . $this->limit($limit);
        return $this->pdoConnect->getAll($sql, $this->prepareParam);
    }
    public function getOne($where = [], $orWhere = [], $fields = ['*']) {
        if(!$this->pdoConnect){
            $this->connectPdo();
        }
        $sql = ' SELECT ' . $this->fields($fields) . ' FROM ' . $this->table . ' WHERE ' . $this->where($where) . $this->orWhere($orWhere) . ' LIMIT 1 ';
        return $this->pdoConnect->getAll($sql, $this->prepareParam);
    }
    public function delete($where = [], $orWhere = []) {
        if(!$this->pdoConnect){
            $this->connectPdo();
        }
        return $this->pdoConnect->delete($this->table, $this->where($where) . $this->orWhere($orWhere), $this->prepareParam);
    }
    public function update($where = [], $orWhere = [], $updateData = []) {
        if(!$this->pdoConnect){
            $this->connectPdo();
        }
        return $this->pdoConnect->update($this->table, $updateData, $this->where($where) . $this->orWhere($orWhere), $this->prepareParam);
    }
    public function getLastsql() {
        if(!$this->pdoConnect){
            $this->connectPdo();
        }
        return $this->pdoConnect->lastSql();
    }
    
    // 使用rawSql方法更新，删除时使用
    public function getAffectedCount() {
        return $this->pdoConnect->count();
    }
    
    // 使用rawSql方法插入时使用
    public function getlastInsertId() {
        return $this->pdoConnect->lastInsertId();
    }
    
    // 使用rawSql方法查询时使用
    public function getResult() {
        return $this->pdoConnect->fetchAll();
    }
}