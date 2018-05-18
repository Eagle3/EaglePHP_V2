<?php
/**
*  隐式
*/
namespace route;

class RouteImplicit {
    public static function dispatch(){
        $r = request();
        $paramArr = getConfigByVar('_ROUTE._PARAM_NAME');
        $m = strtolower($r[$paramArr['_MOULDE']]);
        $c = ucfirst($r[$paramArr['_CONTROLLER']]);
        $a = $r[$paramArr['_ACTION']];
        $classFile = '\\'.$m . '\\' . $c;
        $obj = new $classFile();
        call_user_func_array( array(
                $obj,
                $a,
        ), array() );
    }
}