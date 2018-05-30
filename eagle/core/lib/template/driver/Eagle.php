<?php

namespace core\lib\template\driver;

use core\lib\template\driver\Engine;

class Eagle implements Engine {
    private $eagleConfigArr = [];
    private $smarty = null;
    private $initEagleStatus = false;
    public function __construct($eagleConfigArr){
        $this->eagleConfigArr = $eagleConfigArr;
    }
    public function assign( $key, $val = '' ) {
        if ( !$this->initEagleStatus ) {
            $this->initEagle();
        }
        if ( is_array( $key ) && $key ) {
            foreach ( $key as $k => $v ) {
                $this->eagle->assign( $k, $v );
            }
        } else {
            $this->eagle->assign( $key, $val );
        }
    }
    public function fetch( $tpl ) {
        if ( !$this->initEagleStatus ) {
            $this->initEagle();
        }
        return $this->eagle->fetch( $this->getTplFilePath($tpl) );
    }
    public function display( $tpl ) {
        if ( !$this->initEagleStatus ) {
            $this->initEagle();
        }
        $this->eagle->display( $this->getTplFilePath($tpl) );
    }
    private function getTplFilePath($tpl){
        return $this->eagle->template_dir[0] . $tpl;
    }
    private function initEagle() {
        import( EAGLE_PATH.'core/lib/template/driver/eagle/Autoloader.php' );
        \Smarty_Autoloader::register();
        $this->eagle = new \Smarty();
        $this->initEagleStatus = true;
        
        //设置smarty
        if ( isset( $this->eagleConfigArr["template_dir"] ) ) {
            $this->eagle->template_dir = $this->eagleConfigArr["template_dir"];
        }
        
        if ( isset( $this->eagleConfigArr["compile_dir"] ) ) {
            $this->eagle->compile_dir = $this->eagleConfigArr["compile_dir"];
        }
        
        if ( isset( $this->eagleConfigArr["caching"] ) ) {
            $this->eagle->caching = $this->eagleConfigArr["caching"];
        }
        
        if ( isset( $this->eagleConfigArr["cache_dir"] ) ) {
            $this->eagle->cache_dir = $this->eagleConfigArr["cache_dir"];
        }
        
        if ( $this->eagleConfigArr["cache_lifetime"] ) {
            $this->eagle->caching = true;
            $this->eagle->cache_lifetime = $this->eagleConfigArr["cache_lifetime"];
        }
        
        if ( isset( $this->eagleConfigArr["delimiter"] ) ) {
            $this->eagle->left_delimiter = $this->eagleConfigArr["delimiter"]["left_delimiter"];
            $this->eagle->right_delimiter = $this->eagleConfigArr["delimiter"]["right_delimiter"];
        }
        
        if ( isset( $this->eagleConfigArr["debugging"] ) ) {
            $this->eagle->debugging = $this->eagleConfigArr["debugging"];
        }
    }
}