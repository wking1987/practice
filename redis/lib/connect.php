<?php
class connectClass
{
    protected $host = '127.0.0.1';
    private $port = '6379';

    private $name;//声明一个私有的实例变量
    static public $instance;//声明一个静态变量（保存在类中唯一的一个实例）
    private function __construct(){//声明私有构造方法为了防止外部代码使用new来创建对象。
        $redis = new Redis();
        $redis -> connect($this -> host , $this -> port);
        return $redis;
    }

    static public function getinstance(){//声明一个getinstance()静态方法，用于检测是否有实例对象
        if(!self::$instance) self::$instance = new self();
        return self::$instance;
    }

    public function push($key , $value , $type='l'){
        $funName = $type . 'Push';
        self::$instance -> $funName($key , $value);
    }

    public function pop($key , $type = 'r')
    {
        $funName = $type . 'Pop';
        return self::$instance -> $funName($key);
    }
    public function setname($n){ $this->name = $n; }
    public function getname(){ return $this->name; }
}