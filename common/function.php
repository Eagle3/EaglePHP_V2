<?php
function pr(){
    $args = func_get_args();
    echo '<pre>';
    foreach ($args as $v){
        print_r($v);
        echo '<hr>';
    }
    echo '<pre/>';
    exit;
}