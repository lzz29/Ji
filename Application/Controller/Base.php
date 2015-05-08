<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/8
 * Time: 11:39
 */

namespace Application\Controller;


class Base {

    public function __construct()
    {

    }
    public function check()
    {
        $controller = \Ji\Core\Url::getParam(0);
    }
}