<?php
namespace Application\Controller;

class Index extends \Ji\Core\Controller
{
    public  function index()
    {
        $this->assign('name', 'daijinjiang');
        $this->display('index');
    }
}