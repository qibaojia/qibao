<?php
/**
 * Created by PhpStorm.
 * User: jiayahong
 * Date: 15/4/16
 * Time: 上午10:43
 */
$yii = dirname(__FILE__) . '/vendor/yiisoft/yii2/framework/yii.php';
$config_dir = dirname(__FILE__) . '/config';
// mode.conf文件中存有一个字符串，用来标明当前是哪一种环境，当该文件不存在时，将使用main配置文件，即生产环境。
// mode.conf option:local,develop,test,performance,mirror
$mode_file = $config_dir . '/mode.conf';

if (file_exists($mode_file)) {
    $mode = trim(file_get_contents($mode_file));
    defined('APP_MODE') or define('APP_MODE', $mode);
    $config = $config_dir . '/' . $mode . '.php';

    if (!preg_match('/^\w+$/', trim($mode, ".conf")))
        die('mode error!');
    if (!file_exists($config))
        die('Mode config file is not exists.');

    if ($mode == 'local' || $mode == 'develop' || $mode == 'app') {
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        // specify how many levels of call stack should be shown in each log message
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
    }
} else {
    die('Mode config file is not exists.');
}

// if (extension_loaded('apc'))
    // 	$yii = dirname(__FILE__) . '/../framework/yiilite.php';
// 变更sessionID的cookie名称
session_name('SSID');
// 以分钟数指定缓冲的会话页面的存活期
//session_cache_expire(180);
require_once ($yii);
require dirname(__FILE__).'/../vendor/autoload.php';
Yii::createWebApplication($config)->run();
