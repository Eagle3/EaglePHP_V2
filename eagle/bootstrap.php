<?php
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__DIR__) . DS);

// 项目相关路径
defined('APP_PATH') or define('APP_PATH', ROOT_PATH . 'app' . DS);
defined('APP_HTTP_PATH') or define('APP_HTTP_PATH', APP_PATH . 'http' . DS);
defined('APP_CONTROLLER_PATH') or define('APP_CONTROLLER_PATH', APP_HTTP_PATH . 'controller' . DS);
defined('APP_MODEL_PATH') or define('APP_MODEL_PATH', APP_HTTP_PATH . 'model' . DS);
defined('APP_VIEW_PATH') or define('APP_VIEW_PATH', APP_HTTP_PATH . 'view' . DS);
defined('APP_EXTEND_PATH') or define('APP_EXTEND_PATH', APP_HTTP_PATH . 'extend' . DS);

// 根目录相关路径
defined('ROOT_COMMON_PATH') or define('ROOT_COMMON_PATH', ROOT_PATH . 'common' . DS);
defined('ROOT_CONFIG_PATH') or define('ROOT_CONFIG_PATH', ROOT_PATH . 'config' . DS);
// 存放CSS JS image
defined('ROOT_PUBLIC_PATH') or define('ROOT_PUBLIC_PATH', ROOT_PATH . 'public' . DS);
// 存放字典数据或秘钥文件之类
defined('ROOT_SOURCE_PATH') or define('ROOT_SOURCE_PATH', ROOT_PATH . 'source' . DS);
defined('ROOT_TMP_PATH') or define('ROOT_TMP_PATH', ROOT_PATH . 'tmp' . DS);
defined('ROOT_UPLOAD_PATH') or define('ROOT_UPLOAD_PATH', ROOT_PATH . 'upload' . DS);

// 框架相关路径
defined('EAGLE_PATH') or define('EAGLE_PATH', ROOT_PATH . 'eagle' . DS);
defined('EAGLE_CORE_PATH') or define('EAGLE_CORE_PATH', EAGLE_PATH . 'core' . DS);
defined('EAGLE_CORE_COMMON_PATH') or define('EAGLE_CORE_COMMON_PATH', EAGLE_CORE_PATH . 'common' . DS);
defined('EAGLE_CORE_COMMON_CONFIG_PATH') or define('EAGLE_CORE_COMMON_CONFIG_PATH', EAGLE_CORE_COMMON_PATH . 'config' . DS);
defined('EAGLE_CORE_COMMON_FONT_PATH') or define('EAGLE_CORE_COMMON_FONT_PATH', EAGLE_CORE_COMMON_PATH . 'font' . DS);
defined('EAGLE_CORE_COMMON_LANGUAGE_PATH') or define('EAGLE_CORE_COMMON_LANGUAGE_PATH', EAGLE_CORE_COMMON_PATH . 'language' . DS);
defined('EAGLE_CORE_COMMON_FUNCTION_PATH') or define('EAGLE_CORE_COMMON_FUNCTION_PATH', EAGLE_CORE_COMMON_PATH . 'function' . DS);
defined('EAGLE_CORE_LIB_PATH') or define('EAGLE_CORE_LIB_PATH', EAGLE_CORE_PATH . 'lib' . DS);


// 系统函数库
require EAGLE_CORE_COMMON_FUNCTION_PATH . 'function.php';
// 自定义函数库
require ROOT_COMMON_PATH . 'function.php';

// 配置文件，（如果项目配置有与系统配置相同的选项，则以项目配置为准）
$SYSCONFIG = array_merge((require EAGLE_CORE_COMMON_CONFIG_PATH . 'config.php'), (require ROOT_CONFIG_PATH . 'config.php'));

// 语言包
$LANGCONFIG = getLangConfig($SYSCONFIG['_LANGUAGE']);

// 注册自动加载
use core\lib\autoload\Autoload;
require EAGLE_CORE_LIB_PATH . 'autoload/Autoload.php';

// 运行
use core\lib\app\App;
require EAGLE_CORE_LIB_PATH . 'app/App.php';
App::run();