<?php
/**
 * 调试输出
 */
if(!function_exists('p')){
    function p() {
        $args = func_get_args();
        echo '<pre>';
        foreach($args as $v){
            print_r($v);
            echo '<hr>';
        }
        echo '<pre/>';
        exit();
    }
}

/**
 * 获取系统当前所有用户自定义常量
 */
if(!function_exists('getAllDefined')){
    function getAllDefined() {
        return get_defined_constants(true)['user'];
    }
}

/**
 * 获取配置-方式1 (读取系统文件)
 *
 * @param string $param
 *            配置参数，形如： CHINA.PROVINCE.CITY.COUNTRY 多级参数使用 . 号分割
 * @param array $confArr
 *            要加载的配置文件
 * @return mixed
 */
if(!function_exists('getConfig')){
    function getConfig($param = '', $confArr = array(EAGLE_CORE_COMMON_CONFIG_PATH,ROOT_CONFIG_PATH)) {
        $configData = array();
        foreach($confArr as $v){
            $file = $v . 'config.php';
            $configData = array_merge($configData, require $file);
        }
        if(!$param){
            return $configData;
        }
        if(!$configData){
            return [];
        }
        $param = explode('.', $param);
        if(count($param) == 1){
            return $configData[$param[0]];
        }else{
            foreach($param as $k => $v){
                if($v == '' || $v === null || (!is_int($v) && !is_string($v))){
                    return [];
                    break;
                }
                if(!isset($configData[(int)$v]) && !isset($configData[(string)$v])){
                    return [];
                    break;
                }
                $configData = $configData[$v];
            }
            return $configData;
        }
    }
}

/**
 * 获取配置-方式2 (从变量中获取，优先使用)
 */
if(!function_exists('getConfigByVar')){
    function getConfigByVar($param = '') {
        global $SYSCONFIG;
        $configData = $SYSCONFIG;
        if(!$param){
            return $configData;
        }
        if(!$configData){
            return [];
        }
        $param = explode('.', $param);
        if(count($param) == 1){
            return $configData[$param[0]];
        }else{
            foreach($param as $k => $v){
                if($v == '' || $v === null || (!is_int($v) && !is_string($v))){
                    return [];
                    break;
                }
                if(!isset($configData[(int)$v]) && !isset($configData[(string)$v])){
                    return [];
                    break;
                }
                $configData = $configData[$v];
            }
            return $configData;
        }
    }
}

/**
 * 获取字典数据（一般代替数据库使用，source目录下，以 .dict.php 文件结尾）
 *
 * @param string $param
 *            配置参数，形如： filename.PROVINCE.CITY.COUNTRY 多级参数使用 . 号分割
 */
if(!function_exists('getDict')){
    function getDict($param = '', $path = '') {
        if(!$param){
            return [];
        }
        $param = explode('.', $param);
        if($path){
            $path = rtrim(rtrim($path, '/'), "\\") . '/';
        }
        $configData = require_once ROOT_SOURCE_PATH . "{$path}{$param[0]}.dict.php";
        if(!$configData){
            return [];
        }
        if(count($param) == 1){
            return $configData;
        }else{
            array_shift($param);
            foreach($param as $k => $v){
                if($v == '' || $v === null || (!is_int($v) && !is_string($v))){
                    return [];
                    break;
                }
                if(!isset($configData[(int)$v]) && !isset($configData[(string)$v])){
                    return [];
                    break;
                }
                $configData = $configData[$v];
            }
            return $configData;
        }
    }
}

/**
 * 获取语言包
 *
 * @param string $langName
 *            语言标识
 * @return array
 */
if(!function_exists('getLangConfig')){
    function getLangConfig($langName = 'chinese') {
        return require EAGLE_CORE_COMMON_LANGUAGE_PATH . $langName . '.php';
    }
}

/**
 * 获取get/post数据
 */
if(!function_exists('request')){
    function request($param = [], $isFilter = false) {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = [];
        switch($method){
            case 'get':
                if(!$param){
                    $data = $_GET;
                }elseif($param && is_string($param)){
                    $data = $_GET[$param];
                }elseif($param && is_array($param)){
                    foreach($param as $key){
                        $data[$key] = $_GET[$key];
                    }
                }
                break;
            case 'post':
                break;
                if(!$param){
                    $data = $_POST;
                }elseif($param && is_string($param)){
                    $data = $_POST[$param];
                }elseif($param && is_array($param)){
                    foreach($param as $key){
                        $data[$key] = $_POST[$key];
                    }
                }
            default:
                break;
        }
        if($isFilter && $data){
            return filterData($data);
        }
        return $data;
    }
}

/**
 * 过滤数据
 */
if(!function_exists('filterData')){
    function filterData($data = '') {
        if(!$data){
            return $data;
        }
        if($data){
            //
            return $data;
        }
    }
}

/**
 * 加载未使用命名空间的文件
 */
if(!function_exists('import')){
    function import($file) {
        require_once $file;
    }
}

/**
 * 获取smarty对象
 *
 * @return object Smarty
 */
if(!function_exists('getSmartyObj')){
    function getSmartyObj() {
        require_once SMARTY_PATH;
        Smarty_Autoloader::register();
        return new Smarty();
    }
}


//字符串转16进制
function str2hex($str){
    $hex = '';
    for($i=0,$length=mb_strlen($str); $i<$length; $i++){
        $hex .= dechex(ord($str{$i}));
    }
    return $hex;
}
//pr(str2hex('一国sadhgwshsf')); //输出：    e4b880e59bbd73616468677773687366
//16进制转成字符串
function hex2str($hex){
    $str = '';
    $arr = str_split($hex, 2);
    foreach($arr as $bit){
        $str .= chr(hexdec($bit));
        echo ($str).'<br>';
    }
    return $str;
}
//pr(hex2str('e4b880e59bbd73616468677773687366')); //输出：    一国sadhgwshsf
