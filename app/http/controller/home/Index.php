<?php
namespace http\controller\home;

use core\lib\controller\WebController;
use core\lib\captcha\Captcha;

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
        
    }

    
}
