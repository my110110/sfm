<?php
/**
 * Created by PhpStorm.
 * Users: zyh
 * Date: 2019/5/10
 * Time: 下午9:35
 */

namespace core;


class Controller
{
    protected $_controller;
    protected $_action;
    // 构造函数，初始化属性，并实例化对应模型
    function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
    }

}