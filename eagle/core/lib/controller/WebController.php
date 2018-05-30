<?php

namespace core\lib\controller;

use core\lib\controller\BaseController;
use core\lib\template\Template;

class WebController extends BaseController {
    private $template = NULL;
    public function init() {
        parent::init();
        $this->template = new Template();
    }
    public function fetch($key = '',$val = ''){
       return $this->template->fetch($key,$val);
    }
    public function assign($key = '',$val = ''){
        $this->template->assign($key,$val);
    }
    public function display($tpl = ''){
        $this->template->display($tpl);
    }
}