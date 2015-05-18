<?php
namespace Application\Controller;

class Index extends \Ji\Core\Controller
{
    public function index()
    {
        $this->show('index');
    }
    public function test()
    {
        echo 'test ok';
    }
}