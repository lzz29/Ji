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
        //一些初始化参数都可以写到config.php文件中
        $config = \Ji\Core\Config::loadConfig('config');

        //解析url
        //如果没有controll或action调用默认的参数
        $controller = \Ji\Core\Url::getParam(0);
        if(empty($controller)) $controller = $config['controller'];
        $action = \Ji\Core\Url::getParam(1);
        if(empty($action)) $action = $config['action'];

        //调用控制前调用基类
        //用处:以后如果想验证用户是否登录 只要在check方法里面写逻辑
        //check方法会验证当前的请求的控制器是否需要验证,根据配置文件,具体看check方法代码逻辑
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