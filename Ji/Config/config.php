<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/12
 * Time: 14:20
 */

$config = array();

//默认的控制器、操作设置
$config['controller'] = 'Index';
$config['action'] = 'Index';

//设置基类，调用控制器前 调用此类
$config['baseClass'] = 'Base';

//设置不需调用的基类
$config['public'] = array('Public');


//设置默认模板目录,后面可以写多套皮肤
$config['view'] = 'default';