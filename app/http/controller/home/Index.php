<?php
namespace http\controller\home;
use http\controller\Web;

class Index extends Web{
    public function index(){
        echo 'index';
        $this->assign();
        $this->display();
    }
}
