<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/20
 * Time: 14:53
 */

namespace Ji\Core;

class Mysql {

    static $instance;
    static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new Mysql();
            self::$instance->init();
        }
        return self::$instance;
    }
    //初始化数据库对象
    public function init()
    {
        $config = C('database');
        @$db_connect = mysql_connect($config['host'], $config['username'], $config['password']) or die("Unable to connect to the MySQL!");
        //选择一个需要操作的数据库
        mysql_select_db($config['dbname'],$db_connect);
    }
    /*
     * 执行sql
     */
    public function query($sql)
    {
        $result=mysql_query($sql);
    }
}