<?php
namespace http\controller\api;

use core\lib\controller\ApiController;

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
}
