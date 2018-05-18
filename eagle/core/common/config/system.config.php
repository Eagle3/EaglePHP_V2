<?php
//系统配置文件，键名大写，下划线开头，便于区分项目配置文件
return [
        //语言包
        '_LANGUAGE' => 'chinese',
        //路由控制
        '_ROUTE' => [
                //0隐式 1显式
                '_TYPE' => 0,
                //参数名,_TYPE=1时使用
                '_PARAM_NAME' => [
                        '_MOULDE' => 'm',
                        '_CONTROLLER' => 'c',
                        '_ACTION' => 'a',
                ],
        ],
        //模板
        '_TEMPLATE' => [
                '_DRIVER' => 'Smarty', // Smarty|Eagle
        ],
];
