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

class IncludeController extends Template
{

    public function parseHtml()
    {
        $content = $this->content;
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
        $content = str_replace($match[0], $replace, $content);
        return $content;

    }
}