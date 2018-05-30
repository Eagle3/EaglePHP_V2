<?php

namespace core\lib\template;

use core\lib\template\driver\Smarty;
use core\lib\template\driver\Eagle;

class Template {
    private $driver = NULL;
    public function __construct() {
        $tplConfig = getConfigByVar('_TEMPLATE');
        $driver = $tplConfig['_DRIVER'];
        if(strtolower($driver) == 'smarty'){
            $this->driver = new Smarty($tplConfig['_SMARTY_TPL_CONFIG']);
        }elseif(strtolower($driver) == 'eagle'){
            $this->driver = new Eagle($tplConfig['_EAGLE_TPL_CONFIG']);
        }else{
            $this->driver = new Smarty($tplConfig['_SMARTY_TPL_CONFIG']);
        }
    }
    public function fetch($key = '', $val = '') {
        return call_user_func_array(array(
                $this->driver,
                'fetch',
        ), array(
                $key,
                $val,
        ));
    }
    public function assign($key = '', $val = '') {
        call_user_func_array(array(
                $this->driver,
                'assign' 
        ), array(
                $key,
                $val, 
        ));
    }
    public function display($tpl = '') {
        call_user_func_array(array(
                $this->driver,
                'display', 
        ), array(
                $tpl, 
        ));
    }
}