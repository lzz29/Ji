<?php
namespace Application\Controller;

class Index extends \Ji\Core\Controller
{
    public function index()
    {
        $obj = M('test');
        p($obj);
    }
    public function test()
    {
        echo 'test ok';
    }
}