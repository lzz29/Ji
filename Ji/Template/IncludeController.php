<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/12
 * Time: 13:00
 * DESC: 加载控制器方法
 */

namespace Ji\Template;

use Ji\Template\Template;

class IncludeController implements Template
{
    public function parseHtml($content)
    {
        $partter = '/\{includeController\([\'\"]?(.*?)[\'\"]?\)\}/mi';
        preg_match_all($partter, $content, $match);
        if(empty($match[0]))
            return $content;

        //加载对应的模板文件
        $replace = array();
        $instance = \Ji\Core\Controller::getInstance();
        foreach($match[1] as $val) {
            $replace[] = A($val);
        }
        p($replace, 1);
        //p($replace, 1);
        exit;
        $content = str_replace($match[0], $replace, $content);
        return $content;

    }
}