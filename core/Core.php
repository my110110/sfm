<?php
/**
 * Created by PhpStorm.
 * Users: zyh
 * Date: 2019/5/10
 * Time: 下午9:33
 */

namespace core;


class Core
{
    // 运行程序
    function run()
    {
        spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();

        $this->removeMagicQuotes();

        $this->unregisterGlobals();

        $this->Route();


    }
    // 路由处理
    function Route()
    {
        $controllerName = 'Index';
        $action = 'index';
        if (!empty($_GET['url'])) {
            $url = $_GET['url'];
            $urlArray = explode('/', $url);
            // 获取控制器名
            $controllerName = ucfirst($urlArray[0]);
            // 获取动作名
            array_shift($urlArray);
            $action = empty($urlArray[0]) ? 'index' : $urlArray[0];
            //获取URL参数
            array_shift($urlArray);
            $queryString = empty($urlArray) ? array() : $urlArray;
        }
        // 数据为空的处理
        $queryString  = empty($queryString) ? array() : $queryString;
        // 实例化控制器
        $controller = '\\'.APP_NAME.'\\controllers\\'.$controllerName . 'Controller';
        $dispatch = new $controller($controllerName, $action);
        // 如果控制器存和动作存在，这调用并传入URL参数
        if ((int)method_exists($controller, $action)) {
            call_user_func_array(array($dispatch, $action), $queryString);
        } else {
            exit($controller . "控制器不存在");
        }
    }
    // 检测开发环境
    function setReporting()
    {
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', RUNTIME_PATH. 'logs/error.log');
        }
    }
    // 删除敏感字符
    function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
        return $value;
    }
    // 检测敏感字符并删除
    function removeMagicQuotes()
    {
        if ( get_magic_quotes_gpc()) {
            $_GET = stripSlashesDeep($_GET );
            $_POST = stripSlashesDeep($_POST );
            $_COOKIE = stripSlashesDeep($_COOKIE);
            $_SESSION = stripSlashesDeep($_SESSION);
        }
    }
    // 检测自定义全局变量（register globals）并移除
    function unregisterGlobals()
    {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
    // 自动加载控制器和模型类
    static function loadClass($class)
    {
        $class = str_replace("\\","/",$class);
        $classfile = APP_PATH . $class . '.php';
       if (file_exists($classfile)) {
            include $classfile;
        }
    }

}