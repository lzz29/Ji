<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/12
 * Time: 11:18
 * Desc: 加载模板文件
 */

namespace Ji\Template;

use Ji\Template\Template;

class IncludeView implements Template
{
    public function parseHtml($content)
    {
        $partter = '/\{includeView\([\'\"]?(.*?)[\'\"]?\)\}/mi';
        preg_match_all($partter, $content, $match);
        if(empty($match[0]))
            return $content;

        //加载对应的模板文件
        $replace = array();
        $instance = \Ji\Core\Controller::getInstance();
        foreach($match[1] as $val) {
            $replace[] = $instance->display($val);
        }
        $content = str_replace($match[0], $replace, $content);
        return $content;
    }
}
