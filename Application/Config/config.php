<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/8
 * Time: 9:42
 */

$config = array();

//默认的控制器、操作设置
$config['controller'] = 'Index';
$config['action'] = 'Index';

//设置基类，调用控制器前 调用此类
$config['baseClass'] = 'Base';

//设置不需调用的基类
$config['public'] = array('Public');