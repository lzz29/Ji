<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/8
 * Time: 9:30
 * Desc:加载配置文件类
 */

namespace Ji\Core;


class Config {
    static $array;
    /*
     * 加载配置文件
     */
    static function loadConfig($name)
    {
        if(!self::$array[$name]) {
            $path = './';
            $path .= APP.'/Config/'.$name.'.php';
            if(file_exists($path)) {
                require $path;
                self::$array[$name] = $config;
            } else{
                p($path);
                p('加载配置文件不存在，请检查', 1);
            }
        }
        return self::$array[$name];
    }
}