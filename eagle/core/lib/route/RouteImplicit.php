<?php
/**
*  隐式
*/
namespace core\lib\route;

class RouteImplicit {
    public static function dispatch(){
        $r = request();
        $paramArr = getConfigByVar('_ROUTE._PARAM_NAME');
        $m = strtolower($r[$paramArr['_MOULDE']]);
        $c = ucfirst($r[$paramArr['_CONTROLLER']]);
        $a = $r[$paramArr['_ACTION']];
        $classFile = 'http\\controller\\'.$m . '\\' . $c;
        $obj = new $classFile();
        call_user_func_array( array(
                $obj,
                $a,
        ), array() );
    }
}