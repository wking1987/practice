<?php
class LibConnectClass
{
    protected $host = '';
    private $port = '';

    private $name;//声明一个私有的实例变量
    static public $instance;//声明一个静态变量（保存在类中唯一的一个实例）
    static private $redis_obj;
    private function __construct(){//声明私有构造方法为了防止外部代码使用new来创建对象。
        try{
            $config = ConfigBaseClass::$configReids;
        }catch (Exception $e){
            print_r($e -> getMessage());
            exit;
        }
        $this -> host = $config['host'];
        $this -> port = $config['port'];
        $redis = new Redis();
        $redis -> connect($this -> host , $this -> port);
        self::$redis_obj = $redis;
    }

    static public function getinstance(){//声明一个getinstance()静态方法，用于检测是否有实例对象

        if(!self::$instance) self::$instance = new self();
        return self::$instance;
    }

    public function push($key , $value , $type='l'){
        $funName = $type . 'Push';
        self::$redis_obj -> $funName($key , $value);
    }

    public function pop($key , $type = 'r')
    {
        $funName = $type . 'Pop';
        return self::$redis_obj -> $funName($key);
    }

    public function lSize($key)
    {
        return self::$redis_obj -> lSize($key);
    }

    public function setname($n){ $this->name = $n; }
    public function getname(){ return $this->name; }
}