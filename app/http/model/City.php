<?php
namespace http\model;

use core\lib\model\Model;

class City extends Model {
    public $table = 'cms_city';
    public $connection = 'default';
    
    public function getInfo($where){
        
    }
    
    public function getList($where = [],$orWhere = [],$groupBy = [],$orderBy = [],$limit = [0,0],$fields = ['*']){
        $data = $this->getMore($where,$orWhere,$groupBy,$orderBy,$limit,$fields);
         //p($this->getLastsql());
         return $data;
    }
    
    public function getListRawSql(){
        $sql = ' SELECT * FROM cms_city WHERE  1=1  AND `city_id` < 100  LIMIT 0,100  ';
        $this->rawSql($sql);
        $data = $this->getResult();
        return $data;
    }
}