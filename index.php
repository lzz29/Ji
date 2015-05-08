<?php

//定义applicaiton目录
define('APP', 'Application');

//注册自动加载类
require '/Ji/core/Autoload.php';
spl_autoload_register('\\Ji\\Core\\Autoload::load');

//加载公共函数
require '/Ji/core/function.php';

//解析url,调用对应的控制器
$app = new \Ji\Core\Application();
$app->run();