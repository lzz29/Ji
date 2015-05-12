<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/12
 * Time: 10:19
 */

namespace Ji\Template;


interface Template {

    /*
     * 解析模板并替换
     */
    public function parseHtml($content);
}