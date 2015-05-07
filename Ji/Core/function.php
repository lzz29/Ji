<?php

/**
 * 打印调试函数
 * @param   $val    需要打印的任意类型
 * @param   $type   0默认 1中断程序
 */
function p($val, $type = 0)
{
    echo '<pre>';
    print_r($val);
    echo '</pre>';
    if($type > 0) exit();
}