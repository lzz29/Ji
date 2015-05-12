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
        if($content) {
            return $content;
        } else {
            return $res;
        }
    }
}
