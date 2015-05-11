<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/7
 * Time: 16:34
 */

namespace Ji\Core;


class Autoload {

    static function load($class)
    {
        $path = BASEDIR.'/'.str_replace('\\', '/', $class).'.php';
        require_once $path;
    }
}