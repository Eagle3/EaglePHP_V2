<?php
namespace http\model;

use core\lib\model\Model;

class City extends Model {
    protected $table = 'cms_city';
    protected $connection = 'default';
    
    public function getInfo($where){
        
    }
    
    public function getList($where){
        return $this->fields(['*'])->where($where)->select();
    }
}