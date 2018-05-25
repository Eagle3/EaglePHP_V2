<?php
namespace http\controller;

use core\lib\controller\Controller;

class Web extends Controller{
    public function init(){
        parent::init();
    }
    public function assign($key = '',$val = ''){
        echo 'assign';
    }
    public function display($tpl = ''){
        echo 'display';
    }
}
