<?php
function pr(){
    $args = func_get_args();
    echo '<pre>';
    foreach( $args as $v ){
        print_r( $v );
        echo '<hr>';
    }
    echo '<pre/>';
    exit();
}
/**
 * 打印函数调用堆栈，方便调试
 * @return string
 */
function prstack(){
    $array = debug_backtrace();
    //print_r($array);//信息很齐全
    unset( $array[0] );
    $html = '';
    foreach( $array as $row ){
        $html .= $row['file'] . ':' . $row['line'] . '行,调用方法:' . $row['function'] . "<p>";
    }
    return $html;
}
