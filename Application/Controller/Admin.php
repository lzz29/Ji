<?php
/**
 * Created by http://jinri.info
 * User: Ji
 * Date: 2015/5/20
 * Time: 13:58
 */

namespace Application\Controller;


class Admin extends \Ji\Core\Controller
{
    public function index()
    {
        $topUrl = U('Admin/top');
        $leftUrl = U('Admin/left');
        $this->assign('top', $topUrl);
        $this->assign('left', $leftUrl);
        $this->show('Admin/index');
    }

    public function top()
    {
        $this->show('Admin/top');
    }
    public function left()
    {
        echo 'left';
    }
    public function test()
    {
        $res = $this->db->query('select * from ci_module');
        p($res);
    }
    public  function test1()
    {
        p($this->db, 1);
    }
}