<?php

namespace core\lib\controller;

use core\lib\controller\BaseController;
use plugin\dataConvert\array2Xml_v1\Array2Xml;

class ApiController  extends BaseController{
    public function init() {
        parent::init();
    }
    public function response($data, $code = 1, $msg = 'success', $type = 'json', $jsonpCallBackFun = 'callback'){
        $returnData = ['code' => $code,'msg' => $msg,'data' => $data];
        switch ( $type ) {
            case 'json':
                header( 'Content-type: application/json;charset=utf-8' );
                $res = json_encode( $returnData, JSON_UNESCAPED_UNICODE );
                break;
            case 'xml':
                header( "Content-type: text/xml;charset=utf-8" );
                $res = ( new Array2Xml() )->buildXML( $returnData );
                break;
            case 'jsonp':
                echo $jsonpCallBackFun.'('.json_encode($data).')';
                exit;
        }
        echo $res;
        exit();
    }
}