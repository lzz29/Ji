<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/7
 * Time: 17:00
 */

namespace Ji\Core;


class Application {

    public function run()
    {
        //获取应用的一些基本配置
        $config = \Ji\Core\Config::loadConfig('config');

        //解析url
        $controller = \Ji\Core\Url::getParam(0);
        if(empty($controller)) $controller = $config['controller'];
        $action = \Ji\Core\Url::getParam(1);
        if(empty($action)) $action = $config['action'];

        //调用控制前调用基类
        $base = $config['baseClass'];
        $class = "\\".APP."\\Controller\\".$base;
        $obj = new $class;
        $obj->check();

        //初始化并调用控制器
        $class = "\\".APP."\\Controller\\".ucfirst($controller);
        $obj = new $class();
        $obj->$action();
    }
}