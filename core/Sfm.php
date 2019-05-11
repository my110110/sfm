<?php
/**
 * Created by PhpStorm.
 * Users: zyh
 * Date: 2019/4/5
 * Time: 下午5:11
 */

namespace core;


defined('FRAME_PATH') or define('FRAME_PATH', __DIR__.'/');
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');
defined('APP_NAME') or define('APP_NAME', "App");
defined('APP_DEBUG') or define('APP_DEBUG', false);
defined('CONFIG_PATH') or define('CONFIG_PATH', APP_PATH.'config/');
defined('RUNTIME_PATH') or define('RUNTIME_PATH', APP_PATH.'runtime/');
// 包含配置文件
require APP_PATH . 'config/config.php';
//包含核心框架类
require FRAME_PATH . 'Core.php';

// 实例化核心类
$fast = new Core;
$fast->run();