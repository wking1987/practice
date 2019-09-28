<?php
namespace b;
class classNameB{
    protected static $instance;
    protected function __construct()
    {

    }

    static public function getinstance(){//声明一个getinstance()静态方法，用于检测是否有实例对象
        if(!self::$instance) self::$instance = new self();
        return self::$instance;
    }
    function index(){echo "it's B";}
}