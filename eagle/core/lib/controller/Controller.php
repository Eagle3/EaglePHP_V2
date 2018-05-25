<?php

namespace core\lib\controller;

class Controller {
    public function __construct() {
        if(method_exists($this, 'init')){
            $this->init();
        }
    }
    public function init() {}
    public function __call($method, $args) {
        echo "method doesn't exist";
        exit();
    }
}