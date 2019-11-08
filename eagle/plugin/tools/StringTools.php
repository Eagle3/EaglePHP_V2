<?php

namespace plugin\tools;
class StringTools {

    /**
     * 过滤掉字符中的emoji表情,unicode定义的emoji是四个字符，根据这个原理进行过滤
     * @param $str
     * @return mixed
     */
    function filterEmoji($str){
        $str = preg_replace_callback(//执行一个正则表达式搜索并且使用一个回调进行替换
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $str);
        return $str;
    }

}

