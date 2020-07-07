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

/**
 * 检查输入的数字范围是否合法
 *
 * 注: $decimalsMax 的值最好与 $min $max 中小数点位数一致，
 *     举例，$min $max 中如果有2位小数，$decimalsMax 的值应设置成2，
 *     不要设置成其他数字
 *
 * @param string|int|float $num  待检查的数字
 * @param string $filedInfo      提示语前缀，即表单项名称，如：价格、数量、采购价、单价。也可为空字符串
 * @param string|int|float $min  允许的最小值
 * @param string|int|float $max  允许的最大值
 * @param int $decimalsMax       允许的小数点位数
 * @param bool $isContainMin     最小值是否包含 $min
 * @param bool $isContainMax     最大值是否包含 $max
 * @param bool $isNeedCheckMin   最小值是否需要校验
 * @param bool $isNeedCheckMax   最大值是否需要校验
 * @return bool|string
 */
function checkNumRange($num,$filedInfo,$min = 0.00,$max = 99999.99,$decimalsMax = 2,$isContainMin = true,$isContainMax = true,$isNeedCheckMin = true,$isNeedCheckMax = true){
    $decimalsMax = $decimalsMax <= 0 ? 0 : (int)$decimalsMax;
    $isContainMin = (boolean)$isContainMin;
    $isContainMax = (boolean)$isContainMax;
    $isNeedCheckMin = (boolean)$isNeedCheckMin;
    $isNeedCheckMax = (boolean)$isNeedCheckMax;

    if(!is_numeric($num)){
        return "{$filedInfo}格式有误";
    }

    //小数点后位数判断
    $positionPoint = strpos($num,'.');
    if($decimalsMax > 0){
        if($positionPoint !== false){
            $decimals = trim(substr($num,$positionPoint+1));
            if( mb_strlen(trim(substr($num,0,$positionPoint)),'utf8') <= 0 ){
                return "{$filedInfo}格式有误,没有整数部分";
            }

            $decimalsStr = mb_strlen($decimals,'utf8');
            if ($decimalsStr <= 0){
                return "{$filedInfo}格式有误,没有小数点部分";
            }
            if($decimalsStr > $decimalsMax){
                return "{$filedInfo}小数点位数最多{$decimalsMax}位";
            }
        }
    }else{
        if($positionPoint !== false){
            return "{$filedInfo}格式有误,不能有小数点部分";
        }
    }

    //范围
    if($isNeedCheckMin){
        if($isContainMin){
            if(self::compareFloatNum($num,$min,'<',$decimalsMax)){
                return "{$filedInfo}范围有误，最小值应大于等于{$min}";
            }
        }else{
            if(self::compareFloatNum($num,$min,'<=',$decimalsMax)){
                return "{$filedInfo}范围有误，最小值应大于{$min}";
            }
        }
    }

    if($isNeedCheckMax){
        if($isContainMax){
            if(self::compareFloatNum($num,$max,'>',$decimalsMax)){
                return "{$filedInfo}范围有误，最大值应小于等于{$max}";
            }
        }else{
            if(self::compareFloatNum($num,$max,'>=',$decimalsMax)){
                return "{$filedInfo}范围有误，最大值应小于{$max}";
            }
        }
    }

    return true;
}

/**
 * 比较2个浮点数大小
 *
 * @param float $floatA              浮点数A
 * @param float $floatB              浮点数B
 * @param string $compareModel       比较模式，有效值： >、 >=、 =、 <、 <=
 * @param int $decimals              精确到小数点的位数
 * @return bool
 */
function compareFloatNum($floatA,$floatB,$compareModel,$decimals){
    //查看未做任何处理前的浮点数，序列化之后可以看到小数点之后的数字有可能不一样
    //var_dump(serialize($floatA),serialize($floatB));

    //方案一、使用bcadd函数加0并得到相同的小数点位数
    $decimals = (int)$decimals >= 0 ? (int)$decimals : 0;
    $compareModelDict = ['>','>=','=','<','<=']; //比较模式有效值
    $compareModel = in_array($compareModel,$compareModelDict) ? $compareModel : '';
    $floatA = bcadd( (string)$floatA, '0', $decimals);
    $floatB = bcadd( (string)$floatB, '0', $decimals);
    switch ($compareModel){
        case '>':
            return $floatA > $floatB;
            break;
        case '>=':
            return $floatA >= $floatB;
            break;
        case '=':
            return $floatA == $floatB;
            break;
        case '<':
            return $floatA < $floatB;
            break;
        case '<=':
            return $floatA <= $floatB;
            break;
        default:
            return false;
            break;
    }

    /*
    //方案二、使用bccomp函数并带小数点位数比较
    $decimals = (int)$decimals >= 0 ? (int)$decimals : 0;
    $compareModelDict = ['>','>=','=','<','<=']; //比较模式有效值
    $compareModel = in_array($compareModel,$compareModelDict) ? $compareModel : '';
    $floatA = (string)$floatA;
    $floatB = (string)$floatB;
    switch ($compareModel){
        case '>':
            return bccomp($floatA,$floatB,$decimals) === 1 ? true : false;
            break;
        case '>=':
            $res = bccomp($floatA,$floatB,$decimals);
            if($res === 0 || $res === 1){
                return true;
            }else{
                return false;
            }
            break;
        case '=':
            return bccomp($floatA,$floatB,$decimals) === 0 ? true : false;
            break;
        case '<':
            return bccomp($floatA,$floatB,$decimals) === -1 ? true : false;
            break;
        case '<=':
            $res = bccomp($floatA,$floatB,$decimals);
            if($res === 0 || $res === -1){
                return true;
            }else{
                return false;
            }
            break;
        default:
            return false;
            break;
    }
    */

    //方案三、使用四舍五入得到相同的小数点位数
    /*
    $decimals = (int)$decimals >= 0 ? (int)$decimals : 0;
    $compareModelDict = ['>','>=','=','<','<=']; //比较模式有效值
    $compareModel = in_array($compareModel,$compareModelDict) ? $compareModel : '';
    $floatA = round($floatA, $decimals);
    $floatB = round($floatB, $decimals);
    switch ($compareModel){
        case '>':
            return $floatA > $floatB;
            break;
        case '>=':
            return $floatA >= $floatB;
            break;
        case '=':
            return $floatA == $floatB;
            break;
        case '<':
            return $floatA < $floatB;
            break;
        case '<=':
            return $floatA <= $floatB;
            break;
        default:
            return false;
            break;
    }
    */
}

/**
 * 按指定规则格式化返回浮点数
 *
 * @param float $floatNum            浮点数
 * @param int $decimals              精确到小数点的位数
 * @param boolean $isRound           true:四舍五入 false:非四舍五入
 * @return string
 */
function getFloatNumFormat($floatNum,$decimals,$isRound = true){
    $decimals = (int)$decimals >= 0 ? (int)$decimals : 0;
    if( (boolean)$isRound ){
        return round($floatNum,$decimals);
    }else{
        return bcadd( (string)$floatNum, '0', $decimals);
    }
}

/**
 * 按不同需要 json_decode 数据并返回默认值
 *
 * @param string $jsonStr            json字符串
 * @param bool $isReturnEmptyObj     json_decode后的值，如果不是数组或数组值为空时，是否返回空对象
 * @return array|mixed|object
 */
function jsonDecode($jsonStr,$isReturnEmptyObj = false){
    $data = json_decode($jsonStr,true);
    if(is_array($data)){
        if($data){
            return $data;
        }
        return $isReturnEmptyObj ? (object)[] : [];
    }
    return $isReturnEmptyObj ? (object)[] : [];
}


/**
 * 中文格式的计算公式 转为 规定格式的计算公式
 * 示例：
 *   $calcShow = 上楼费 * 0.1 + (垃圾费 * 0.1) + ((搬运费(1) * 0.1) + 200) * 运输费
 *      转成
 *   $calc = $c_101 * 0.1 + ($c_102 * 0.1) + (($c_103 * 0.1) + 200) * $c_104
 *
 * @param string $calcShow    中文格式公式，形如： 上楼费 * 0.1 + 报价定额费用
 * @param array $sysVarArr    系统附加费用变量字典，形如: [ '报价商品费用' => '$c_product_total_price', '报价定额费用' => '$c_quota_total_price' ]
 * @param array $chargeArr    附加费用主项字典，形如: [ '上楼费' => 101, '搬运费' => 102 ]
 * @return array
 */
function getCalcContent($calcShow,$sysVarArr,$chargeArr){
    $contentVar = [];
    foreach ($sysVarArr as $sysVarName => $sysVarValue){
        //如果存在系统变量，则替换
        if(strpos($calcShow,$sysVarName) !== false){
            $contentVar[] = $sysVarValue;
            $calcShow = str_replace($sysVarName,$sysVarValue,$calcShow);
        }
    }
    if($chargeArr){
        foreach ($chargeArr as $chargeName => $chargeId){
            //如果存在附加费用主项名称，则替换
            if(strpos($calcShow,$chargeName) !== false){
                $calcName = '$c_'.$chargeId;
                $contentVar[] = $calcName;
                $calcShow = str_replace($chargeName,$calcName,$calcShow);
            }
        }
    }
    return [
        'content_var' => $contentVar, //该公式中所有变量名称,示例 [ '$c_101','$c_product_total_price' ]
        'calc' => $calcShow, //中文公式 经过字符串替换后的 公式,示例 $c_101 * 0.1 + $c_product_total_price
    ];
}
//$calcShow = "上楼费 * 0.1 + (垃圾费 * 0.1) + ((搬运费(1) * 0.1) + 200) * 运输费 + 报价全部费用(商品+定额) + 报价定额费用 + 报价商品费用";
//$sysVarArr = [
//    '报价商品费用' => '$c_product_total_price',
//    '报价定额费用' => '$c_quota_total_price',
//    '报价全部费用(商品+定额)' => '$c_all_total_price',
//];
//$chargeArr = [
//    '上楼费' => 101,
//    '垃圾费' => 102,
//    '搬运费(1)' => 103,
//    '运输费' => 104,
//];
//p(getCalcContent($calcShow,$sysVarArr,$chargeArr));





































