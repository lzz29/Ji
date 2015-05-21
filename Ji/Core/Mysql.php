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

    private $fields = array();      //查询字段

    static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new Mysql();
            self::$instance->initDb();
        }
        return clone self::$instance;
    }
    //初始化对象数据
    //初始化数据库对象
    public function initDb()
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
        //$this->initDb();
        @$result=mysql_query($sql);
        $array = array();
        while($row = mysql_fetch_field($result)) {
            $array[] = (array)$row;
        }
        return $array;
    }
    /*
     * 设置指段
     */
    public function field($fields)
    {
        $this->fields = $fields;
        return $this;
    }
}