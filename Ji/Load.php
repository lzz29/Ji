<?php

//注册自动加载类
require 'core/Autoload.php';
spl_autoload_register('\\Ji\\core\\Autoload::load');

//加载公共函数
require 'core/function.php';

//解析路由
