<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/12
 * Time: 10:19
 */

namespace Ji\Template;


class Template {

    protected $content;
    protected $vars;
    static $scontent;
    static $svars;
    public function __construct()
    {
        $this->content = self::$scontent;
        $this->vars = self::$svars;
    }
    static function setParam($content, $vars)
    {
        self::$scontent = $content;
        self::$svars = $vars;
    }
    public function fliter()
    {
        $content = $this->parseHtml();
        self::$scontent = $content;
    }
}