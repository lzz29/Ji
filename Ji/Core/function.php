<?php

/**
 * 打印调试函数
 * @param   $val    需要打印的任意类型
 * @param   $type   0默认 1中断程序
 */

if(!function_exists('p')) {
    function p($val, $type = 0)
    {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
        if($type > 0) exit();
    }
}

/**
 * 加载控制器方法
 */
if(!function_exists('A')) {
    function A($value)
    {
        $value = ltrim($value, '/');
        $array = explode("/", $value);
        $count = count($array);
        if($count != 2 && $count !=3)
            return 0;

        ob_start();
        if($count == 2) {
            //当前应用下调用控制器
            $path = '\\'.APP.'\\Controller\\'.$array[0];
            $obj = new $path();
            $res = $obj->$array[1]();
        } else {
            //模块调用控制器
            $path = '\\'.$array[0].'\\Controller\\'.$array[1];
            $obj = new $path();
            $res = $obj->$array[2]();
        }
        $content = ob_get_contents();
        ob_end_clean();
        //如果缓存中有内容将优先输出
        if(!empty($content)) {
            return $content;
        } else {
            return $res;
        }
    }
}
/*
 *  调用model,返回对象
 *  @param  $value  model名
 *  @param  $app    应用名
 */
if(!function_exists('M')) {
    function M($value, $app='')
    {
        $value = ucfirst($value);
        $value = ltrim($value, '/');
            //当前应用下调用控制器
        if($app) {
            $path = '\\'.$app.'\\Model\\'.$value;
        } else {
            $path = '\\'.APP.'\\Model\\'.$value;
        }
        return new $path();
    }
}
/*
 *  获取配置文件
 *  @param  $file   配置文件名
 *  @param  $field  参数名称
 */
if(!function_exists('C')) {
    function C($file, $field = '')
    {
        $config = \Ji\Core\Config::loadConfig($file, $field);
        return $config;
    }
}
