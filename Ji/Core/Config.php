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
     * @param   配置文件名
     * @param   对应配置中的某个字段
     */
    static function loadConfig($fileName, $field = '')
    {
        if(!isset(self::$array[$fileName])) {
            $dir = array(BASEDIR.'/Ji/Config/' ,BASEDIR.'/'.APP.'/Config/');
            $array = array();
            foreach($dir as $val) {
                $path = $val.$fileName.'.php';
                if(file_exists($path)) {
                    require $path;
                    $array = array_merge($array, $config);
                }
            }
            self::$array[$fileName] = $array;
        }
        if(!empty($field))
        {
            //只返回某个字段
            return self::$array[$fileName][$field];
        } else {
            //返回所有字段
            return self::$array[$fileName];
        }
    }
}