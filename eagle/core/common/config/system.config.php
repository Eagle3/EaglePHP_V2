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
                // Smarty|Eagle
                '_DRIVER' => 'Smarty',
                
                // smarty模板引擎配置
                '_SMARTY_TPL_CONFIG' => array(
                        'debugging' => false, // 开启调试
                        'caching' => false, // 是否使用缓存
                        'cache_lifetime' => 0, // 缓存时间
                        'template_dir' => APP_VIEW_PATH, // 设置模板目录
                        'compile_dir' => './tmp/smarty_templates_c', // 设置编译目录
                        'cache_dir' => './tmp/cache/smarty_templates_cache', // 缓存文件夹
                        // 修改左右边界符号
                        'delimiter' => array(
                                'left_delimiter' => '{%',
                                'right_delimiter' => '%}'
                        )
                        
                ),
                
                // 系统内置模板引擎配置
                '_EAGLE_TPL_CONFIG' => array(
                        'debugging' => false, // 开启调试
                        'caching' => false, // 是否使用缓存
                        'cache_lifetime' => 0, // 缓存时间
                        'template_dir' => APP_VIEW_PATH, // 设置模板目录
                        'compile_dir' =>  '/tmp/eagle_templates_c/', // 设置编译目录
                        'cache_dir' => '/tmp/cache/eagle_templates_cache/', // 缓存文件夹
                        // 修改左右边界符号
                        'delimiter' => array(
                                'left_delimiter' => '{',
                                'right_delimiter' => '}'
                        )
                        
                ),
        ],
];
