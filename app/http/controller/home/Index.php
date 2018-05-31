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
//         $pdo = new Pdo('default');
//         echo $pdo->getErrMsg();
//         $sql = ' SELECT * FROM `citycode` WHERE id<? ';
//         $data = $pdo->getAll($sql,[10]);
        
//         $sql = ' SELECT * FROM `citycode` WHERE id in (?,?,?) ';
//         $pdo->execute($sql,[15,16,17]);
//         $data = $pdo->count();
//         p($data,$pdo->fetchAll());
        
         $model = new City();
//         $where = [
//                 ['city_id','<',"100 or 1=1"],
//                 //['city_id','in',[51,90]],
//                 //['city_id','between and',[60,63]],
//                 //['city_id','not between and',[70,80]],
//                 //['cityname',' LIKE','北'],
//                 //['cityname','BEFORE LIKE','北'],
//                 //['cityname','AFTER LIKE','北'],
//                 //['cityname','NOT LIKE','北'],
//                 //['cityname','BEFORE NOT LIKE','北'],
//                 //['cityname','AFTER NOT LIKE','北'],
//                 //['cityname','IS NULL',],
//                 //['cityname','IS NOT NULL',],
//         ];
//         $orWhere = [];
//         $groupBy = ['province_id'];
//         $orderBy = ['province_id'=>'asc'];
//         $limit = [0,0];
//         $fields = ['*'];
//         $data = $model->getList($where,[],[],[],$limit,$fields);
//         p($data);
        
        $data = $model->getListRawSql();
        p($data);
    }

    
}
