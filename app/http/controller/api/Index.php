<?php
namespace http\controller\api;

use core\lib\controller\ApiController;
use plugin\combination\Combination;

class Index extends ApiController {
    public function init(){
        parent::init();
    }
    public function index(){
        $data = [
                'name' => 'jack',
        ];
        $this->response($data,1,'success','json');
        //$this->response($data,0,'success','xml');
        //$this->response($data,0,'success','jsonp');
    }

    public function combination(){
        $data = [
            1,2,3,4,5,6,7,8,9,10
        ];
        $res = Combination::getRes($data);

        p($res);
    }

}
