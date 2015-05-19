<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL & ~ E_WARNING);

define('BASEDIR', str_replace('\\', '/', __DIR__));

//定义applicaiton目录
define('APP', 'Application');

//注册自动加载类
require BASEDIR.'/Ji/Core/Autoload.php';;
spl_autoload_register('Ji\\Core\\Autoload::load');

//加载公共函数
require BASEDIR.'/Ji/core/function.php';

//解析url,调用对应的控制器
$app = new Ji\Core\Application();
$app->run();

