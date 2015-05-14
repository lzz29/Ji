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
    static $obj;          //只创建一个对象

    public function __construct()
    {
        if(!self::$obj) {
            self::$obj = &$this;
        }
        return self::$obj;
    }

    /**
     * 获取controller实例
     */
    static function getInstance()
    {
        return self::$obj;
    }

    public function show($view, $type=0)
    {
        //获取模板内容
        $content = $this->display($view);
        //匹配模板中的标签
        $content = $this->matchContent($content);
        if($type == 0)
            echo $content;
        else
            return $content;
    }
    /**
     * 调用模板信息
     * @param $view 模板名称
     *
     */
    public function display($view)
    {
        //开启缓存
        ob_start();
        //获取模板路径
        $path = $this->getViewPath($view);
        //包含模板
        include $path;
        //获取缓存
        $content = ob_get_contents();
        //清空并关闭缓存
        ob_end_clean();
        return $content;
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
    private function getViewPath($view)
    {
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
        $open = C('config', 'template');
        //模板默认开启
        if($open != 1)
            return $content;

        //设置基本参数
        \Ji\Template\Template::setParam($content, $this->var);
        //加载模板插件
        $plugins = C('config', 'auto_template_plugin');
        foreach($plugins as $obj) {
            $name = '\\Ji\\Template\\'.$obj;
            $obj = new $name();
            $obj->fliter();
        }
        $content = \Ji\Template\Template::$scontent;
        return $content;
    }
}