<?php
/**
*  隐式
*/
namespace core\lib\route;

class RouteImplicit {
    public static function dispatch(){
        $r = request();
        $paramArr = getConfigByVar('_ROUTE._PARAM_NAME');
        $m = isset($r[$paramArr['_MOULDE']]) && $r[$paramArr['_MOULDE']] ? strtolower($r[$paramArr['_MOULDE']]) : 'home';
        $c = isset($r[$paramArr['_CONTROLLER']]) && $r[$paramArr['_CONTROLLER']] ? ucfirst($r[$paramArr['_CONTROLLER']]) : 'Index';
        $a = isset($r[$paramArr['_ACTION']]) && $r[$paramArr['_ACTION']] ? $r[$paramArr['_ACTION']] : 'index';
        $classFile = 'http\\controller\\'.$m . '\\' . $c;
        $obj = new $classFile();
        call_user_func_array( array(
                $obj,
                $a,
        ), array() );
    }
}