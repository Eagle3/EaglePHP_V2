<?php
namespace http\controller\home;

use core\lib\controller\WebController;
use core\lib\captcha\Captcha;
use core\lib\pdo\Pdo;
use core\lib\model\Model;
use http\model\City;

class Index extends WebController {
    public function init(){
        parent::init();
    }
    public function index(){
        echo 'index';
        
        $this->assign([
                'name' => 'jack'
        ]);
        
        $data = $this->fetch('default/index/index.html');
        var_dump($data);
        
        
        $this->display('default/index/index.html');
    }
    
    public function code(){
        Captcha::init();
        Captcha::set( array(
                'width' => 100,
                'height' => 40
        ) );
        Captcha::output();
    }
    public function db(){
        $pdo = new Pdo('default');
        echo $pdo->getErrMsg();
        $sql = ' SELECT * FROM `citycode` WHERE id<? ';
        $data = $pdo->getAll($sql,[10]);
        
        $sql = ' SELECT * FROM `citycode` WHERE id<10 ';
        $pdo->execute($sql);
        $data = $pdo->count();
        p($data,$pdo->fetchAll());
        
        $model = new City();
        $data = $model->getList([['id','<',10]]);
        p($data);
    }

    
}
