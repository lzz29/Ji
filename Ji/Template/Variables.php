<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/12
 * Time: 10:26
 */

namespace Ji\Template;

use Ji\Template\Template;

class Variables implements Template
{
    private $var = array();

    //替换模板标签
    public function parseHtml($content)
    {
        //匹配左右符号的正则
        $pattern = '/\{\$(.*?)\}/m';

        preg_match_all($pattern, $content, $match);

        //存在模板变量就开始匹配
        if(count($match['1']) > 0) {
            //获取每个替换的对应值
            $values = array();
            foreach($match['1'] as $val) {
                $values[] = $this->var[$val];
            }
            //替换内容
            $content = str_replace($match[0], $values, $content);
        }
        return $content;
    }
    /**
     * 设置需要的变量
     */
    public function setVar($var)
    {
        $this->var = $var;
    }
}