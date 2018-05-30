<?php

namespace core\lib\autoload;

class Autoload {
    public static function register() {
        spl_autoload_register(array(
                new self(),
                'autoload' 
        ));
    }
    private function autoload($class) {
        $class = str_replace(array(
                '\\',
                '/' 
        ), DIRECTORY_SEPARATOR, $class);
        
        $classFile = $class . '.php';
        
        // 框架eagle目录
        if(file_exists(EAGLE_PATH . $classFile)){
            echo '<br>'.EAGLE_PATH . $classFile . '<br>';
            require_once EAGLE_PATH . $classFile;
            return true;
        }
        
        // 项目app目录
        if(file_exists(APP_PATH . $classFile)){
            echo '<br>'.APP_PATH . $classFile . '<br>';
            require_once APP_PATH . $classFile;
            return true;
        }
        
        return false;
    }
}
Autoload::register();