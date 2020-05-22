<?php
/**
 * Created by wking
 * Date: 2020/4/18
 * Time: 18:10
 */

class A
{
    protected $info;
    protected $b;
    public function __construct($b = null)
    {
        $b = new B();
    }
    public function a()
    {

    }
}

class B
{
    public function __construct()
    {
    }

    public function b()
    {
        return 'class B function b';
    }
}

$b = new B();