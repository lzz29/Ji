<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/8
 * Time: 9:04
 */

namespace Ji\Core;


class Url {

    static private $params;

    /*
     *  获取url中的参数，index.php后面的都为参数
     *  eg:http://localhost/Ji/index.php/Index/show
     *  $number = 0 将获取"Index"
     *  @param  $number 需要获取url的第几个参数
     */
    static function getParam($number)
    {
        if(empty(self::$url))
        {
            @$string = $_SERVER['REQUEST_URI'];
            $params = explode('/', $string);
            if(count($params) > 3) {
                array_shift($params);
                array_shift($params);
                array_shift($params);
            } else {
                $params = array();
            }
            self::$params = $params;
        }
        if(isset(self::$params[$number]))
            return self::$params[$number];
        else
            return '';
    }
}