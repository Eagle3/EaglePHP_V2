<?php

namespace autoload;

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
        
        // 框架lib目录
        if(file_exists(EAGLE_CORE_LIB_PATH . $classFile)){
            echo '<br>'.EAGLE_CORE_LIB_PATH . $classFile . '<br>';
            require_once EAGLE_CORE_LIB_PATH . $classFile;
            return true;
        }
        
        // 项目controller目录
        if(file_exists(APP_CONTROLLER_PATH . $classFile)){
            echo '<br>'.APP_CONTROLLER_PATH . $classFile . '<br>';
            require_once APP_CONTROLLER_PATH . $classFile;
            return true;
        }
        
        // 项目model目录
        if(file_exists(APP_MODEL_PATH . $classFile)){
            echo '<br>'.APP_MODEL_PATH . $classFile . '<br>';
            require_once APP_MODEL_PATH . $classFile;
            return true;
        }
        
        // http目录
        if(file_exists(APP_HTTP_PATH . $classFile)){
            echo '<br>'.APP_HTTP_PATH . $classFile . '<br>';
            require_once APP_HTTP_PATH . $classFile;
            return true;
        }
        
        // 第三方extend目录
        if(file_exists(EAGLE_EXTEND_PATH . $classFile)){
            echo '<br>'.EAGLE_EXTEND_PATH . $classFile . '<br>';
            require_once EAGLE_EXTEND_PATH . $classFile;
            return true;
        }
        
        return false;
    }
}
Autoload::register();