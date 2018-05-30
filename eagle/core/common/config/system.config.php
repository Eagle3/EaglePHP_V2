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
                '_SMARTY_TPL_CONFIG' => [
                        'debugging' => false, // 开启调试
                        'caching' => false, // 是否使用缓存
                        'cache_lifetime' => 0, // 缓存时间
                        'template_dir' => APP_VIEW_PATH, // 设置模板目录
                        'compile_dir' => './tmp/smarty_templates_c', // 设置编译目录
                        'cache_dir' => './tmp/cache/smarty_templates_cache', // 缓存文件夹
                        // 修改左右边界符号
                        'delimiter' => [
                                'left_delimiter' => '{%',
                                'right_delimiter' => '%}'
                        ],
                        
                ],
                
                // 系统内置模板引擎配置
                '_EAGLE_TPL_CONFIG' => [
                        'debugging' => false, // 开启调试
                        'caching' => false, // 是否使用缓存
                        'cache_lifetime' => 0, // 缓存时间
                        'template_dir' => APP_VIEW_PATH, // 设置模板目录
                        'compile_dir' =>  '/tmp/eagle_templates_c/', // 设置编译目录
                        'cache_dir' => '/tmp/cache/eagle_templates_cache/', // 缓存文件夹
                        // 修改左右边界符号
                        'delimiter' => [
                                'left_delimiter' => '{',
                                'right_delimiter' => '}'
                        ],
                        
                ],
        ],
        
        //是否开启session
        '_SESSION_OPEN' => true,
        
        // 验证码验证类型： 1，cookie 2，session
        '_DEFAULT_CODE_VERIFY' => 1,
        '_DEFAULT_CODE_NAME' => '_verifyCode',
        
        // 数据库配置
        '_PDO_CONFIG' => [
                'default' => [
                        'host' => 'localhost',
                        'userName' => 'root',
                        'passWord' => 'root',
                        'port' => 3306,
                        'dbName' => 'test',
                        'prefix' => '',
                        'charSet' => 'utf8',
                        'driverOptions' => [],
                ],
                'connection1' => [
                        'host' => 'localhost',
                        'userName' => 'root',
                        'passWord' => 'root',
                        'port' => 3306,
                        'dbName' => 'test',
                        'prefix' => '',
                        'charSet' => 'utf8',
                        'driverOptions' => [],
                ],
                'connection2' => [
                        'host' => 'localhost',
                        'userName' => 'root',
                        'passWord' => 'root',
                        'port' => 3306,
                        'dbName' => 'test',
                        'prefix' => '',
                        'charSet' => 'utf8',
                        'driverOptions' => [],
                ],
        ],
        
        // 缓存配置
        '_CACHE_CONFIG' => [
                'FILE' => [
                        'CACHE_TIME' => 3, // 缓存时间
                        'CACHE_PATH' => './tmp/cache/file_cache/', // 设置文件缓存目录
                        'CACHE_PREFIX' => 'file', // 文件缓存前缀
                        'CACHE_POSTFIX' => '.txt'  // 缓存文件后缀名
                ],
                'REDIS' => [
                        'SELECT_DB' => 0, //默认选择的数据库
                        'CACHE_TIME' => 3, // 缓存时间
                        // 多台redis服务器
                        'SERVERS' => [
                                [
                                        'HOST' => '10.0.2.195',
                                        'PORT' => '6379'
                                ],
                                // ['HOST' => '127.0.0.1', 'PORT' => '6379',),
                                // ['HOST' => '10.0.6.194', 'PORT' => '6379',),
                       ],
                ],
                'MEMCACHE' => [
                        'CACHE_TIME' => 3, // 缓存时间
                        // 多台memcache服务器
                        'SERVERS' => [
                                [
                                        'HOST' => '127.0.0.1',
                                        'PORT' => '11211'
                                ],
                                // ['HOST' => '10.0.6.194', 'PORT' => '11211',),
                        ],
                ],
        ],
];
