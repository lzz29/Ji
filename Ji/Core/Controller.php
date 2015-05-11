<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/8
 * Time: 13:19
 * Desc: 所有controller的基类
 */

namespace Ji\Core;


class Controller
{
    public $var = array();//将需要分类的变量分类到模板中
    /**
     * 调用模板信息
     * @param $view 模板名称
     *
     */
    public function display($view)
    {
        $this->view = $view;
        //开启缓存
        ob_start();
        //开始获取内容,将内容先写入缓存
        if(!empty($this->var)) {
            extract($this->var);
        }
        //获取模板路径
        $path = $this->getViewPath();
        //包含模板
        include $path;
        //获取缓存
        $content = ob_get_contents();
        //匹配模板变量
        $content = $this->matchContent($content);
        //清空并关闭缓存
        ob_end_clean();
    }
    /**
     *  将变量分类到模板
     * @param   模板中调用的变量名
     * @param   变量值
     */
    public function assign($key, $value)
    {
        $this->var[$key] = $value;
    }
    /*
     *  获取模板路径
     */
    private function getViewPath()
    {
        $view = $this->view;
        $default = \Ji\Core\Config::loadConfig('config', 'view');
        $view = trim($view, '/');
        $path = BASEDIR.'/'.APP.'/View/'.$default."/".$view.'.php';
        return $path;
    }
    /*
     * 匹配模板变量
     */
    public function matchContent($content)
    {

    }
}