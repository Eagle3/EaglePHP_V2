<?php

namespace core\lib\app;
use core\lib\route\RouteExplicit;
use core\lib\route\RouteImplicit;

class App {
    public static function run(){
        $routeType = (int)getConfigByVar('_ROUTE._TYPE');
        if($routeType == 0){
            RouteImplicit::dispatch();
        }elseif($routeType == 1){
            RouteExplicit::dispatch();
        }
    }
}