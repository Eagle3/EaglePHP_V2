<?php
namespace core\lib\template\driver;

interface Engine {
    public function assign( $key, $val = '' );
    public function fetch( $tpl );
    public function display( $tpl );
}