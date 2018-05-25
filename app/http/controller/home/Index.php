<?php
namespace http\controller\home;
use http\controller\Web;
use core\lib\controller\Controller;

class Index extends Web {
    public function init(){
        parent::init();
    }
    public function index(){
        echo 'index';
        $this->assign();
        $this->display();
    }
}
