<?php
namespace Application\Controller;

class Index extends \Ji\Core\Controller
{
    public function index()
    {
        $this->assign('name', 'daijinjiang');
        $this->assign('age', '13');
        $this->show('index');
    }
    public function test()
    {
        echo 'test ok';
    }
}