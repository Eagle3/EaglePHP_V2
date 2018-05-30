<?php
namespace http\controller\home;

use core\lib\controller\WebController;

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
}
