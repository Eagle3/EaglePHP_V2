<?php

namespace core\lib\template\driver;

use core\lib\template\driver\Engine;

class Smarty implements Engine {
    private $smartyConfigArr = [];
    private $smarty = null;
    private $initSmartyStatus = false;
    public function __construct($smartyConfigArr) {
        $this->smartyConfigArr = $smartyConfigArr;
    }
    public function assign($key, $val = '') {
        if(!$this->initSmartyStatus){
            $this->initSmarty();
        }
        if(is_array($key) && $key){
            foreach($key as $k => $v){
                $this->smarty->assign($k, $v);
            }
        }else{
            $this->smarty->assign($key, $val);
        }
    }
    public function fetch($tpl) {
        if(!$this->initSmartyStatus){
            $this->initSmarty();
        }
        return $this->smarty->fetch($this->getTplFilePath($tpl));
    }
    public function display($tpl) {
        if(!$this->initSmartyStatus){
            $this->initSmarty();
        }
        $this->smarty->display($this->getTplFilePath($tpl));
    }
    private function getTplFilePath($tpl) {
        return $this->smarty->template_dir[0] . $tpl;
    }
    private function initSmarty() {
        import(EAGLE_PATH . 'core/lib/template/driver/smarty/Autoloader.php');
        \Smarty_Autoloader::register();
        $this->smarty = new \Smarty();
        $this->initSmartyStatus = true;
        
        // 设置smarty
        if(isset($this->smartyConfigArr["template_dir"])){
            $this->smarty->template_dir = $this->smartyConfigArr["template_dir"];
        }
        
        if(isset($this->smartyConfigArr["compile_dir"])){
            $this->smarty->compile_dir = $this->smartyConfigArr["compile_dir"];
        }
        
        if(isset($this->smartyConfigArr["caching"])){
            $this->smarty->caching = $this->smartyConfigArr["caching"];
        }
        
        if(isset($this->smartyConfigArr["cache_dir"])){
            $this->smarty->cache_dir = $this->smartyConfigArr["cache_dir"];
        }
        
        if($this->smartyConfigArr["cache_lifetime"]){
            $this->smarty->caching = true;
            $this->smarty->cache_lifetime = $this->smartyConfigArr["cache_lifetime"];
        }
        
        if(isset($this->smartyConfigArr["delimiter"])){
            $this->smarty->left_delimiter = $this->smartyConfigArr["delimiter"]["left_delimiter"];
            $this->smarty->right_delimiter = $this->smartyConfigArr["delimiter"]["right_delimiter"];
        }
        
        if(isset($this->smartyConfigArr["debugging"])){
            $this->smarty->debugging = $this->smartyConfigArr["debugging"];
        }
    }
}