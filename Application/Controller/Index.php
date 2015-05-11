<?php
namespace Application\Controller;

class Index extends \Ji\Core\Controller
{
    public  function index()
    {
        echo 'hello world';
        $this->display('index');
    }
}