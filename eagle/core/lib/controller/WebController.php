<?php

namespace core\lib\controller;

use core\lib\controller\BaseController;
use core\lib\template\Template;

class WebController extends BaseController {
    protected $verifyType = 'cookie';
    protected $verifyName = '_verifyCode';
    private $template = NULL;
    public function init() {
        parent::init();
        $this->template = new Template();
        $verifyType = getConfigByVar( '_DEFAULT_CODE_VERIFY' );
        if ( ( int )$verifyType == 1 ) {
            $this->verifyType = 'cookie';
        } else {
            $this->verifyType = 'session';
        }
        $verifyName = getConfigByVar( '_DEFAULT_CODE_NAME' );
        $this->verifyName = $verifyName;
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
    public function verifyCode( $code ) {
        if ( $this->verifyType == 'cookie' && isset( $_COOKIE[$this->verifyName] ) && strtolower( $code ) == strtolower( $_COOKIE[$this->verifyName] ) ) {
            return true;
        }
        if ( $this->verifyType == 'session' && isset( $_SESSION[$this->verifyName] ) && strtolower( $code ) == strtolower( $_SESSION[$this->verifyName] ) ) {
            return true;
        }
        return false;
    }
}