<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/20
 * Time: 13:58
 */

namespace Application\Controller;


class Test extends \Ji\Core\Controller
{
    public function t1()
    {
        //p('t1');
        return $this->db;
    }
}
