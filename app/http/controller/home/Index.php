<?php
namespace http\controller\home;

use core\lib\controller\WebController;
use plugin\system\captcha\Captcha;
use core\lib\model\Model;
use http\model\City;
use plugin\system\Curl;

class Index extends WebController {
    public function init(){
        parent::init();
    }
    public function index(){
        
        //写入cookie，通知另一个应用（1.通过script标签链接另一个应用的PHP地址 2.通过iframe标签链接另一个应用的PHP地址 3.curl行不通）也写入此cookie数据即完成同步登录
        setcookie('name','jack',time()+3600*24*30,'/');
//         Curl::init('http://eagle.local/index.php?r=home&c=index&a=crossCookie',['name' => 'jack'],'GET');
//         $res = Curl::send();
//         var_dump($res);
        
        
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
