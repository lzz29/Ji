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

    private $db;                    //mysql连接对象

    static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new Mysql();
            self::$instance->initDb();
        }
        return self::$instance;
    }
    //初始化对象数据
    //初始化数据库对象
    public function initDb()
    {
        $config = C('database');
        $mysqli = new \mysqli($config['host'], $config['username'], $config["password"], $config['dbname']);
        $mysqli->set_charset('utf-8');
        $this->db = $mysqli;
    }
    /*
     * 执行sql
     */
    public function query($sql)
    {
        $info = $this->db->query($sql);
        $array = array();
        if($info) {
            while($myrow = $info->fetch_array(MYSQLI_ASSOC))
            {
                p($myrow);
            }
        }
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