<?php
namespace lib;
use config\ConfigBaseClass;
class LibConnectClass
{
    protected $host = '';
    private $port = '';
    static $life_time = 60;

    private $name;//声明一个私有的实例变量
    static public $instance;//声明一个静态变量（保存在类中唯一的一个实例）
    static private $redis_obj;
    private function __construct(){//声明私有构造方法为了防止外部代码使用new来创建对象。
        $config = ConfigBaseClass::$configReids;
        $this -> host = $config['host'];
        $this -> port = $config['port'];
        $redis = new \Redis();
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

    /**
     * 返回名称为key的list有多少个元素
     * @param $key
     * @return int
     */
    public function lSize($key)
    {
        return self::$redis_obj -> lSize($key);
    }

    public function sIsMember($key , $value)
    {
        return self::$redis_obj -> sIsMember($key , $value);
    }



    /**
     * 判断key是否存在
     * @param $key
     * @return bool
     */
    public function exists($key)
    {
        return self::$redis_obj -> exists($key);
    }

    public function set($key , $value)
    {
        return self::$redis_obj -> set($key , $value);
    }

    /**
     * 获取
     * @param $key
     * @return bool|string
     */
    public function get($key)
    {
        return self::$redis_obj -> get($key);
    }

    /**
     * 判断似乎否重复的写入值
     * @param $key
     * @param $value
     * @return bool
     */
    public function setnx($key , $value)
    {
        return self::$redis_obj -> setnx($key , $value);
    }

    /**
     * 设置带生命时间的值
     * @param $key
     * @param $value
     * @param int $time
     * @return bool
     */
    public function setex($key , $value , $time = 0)
    {
        $time = $time > 0 ? $time : self::life_time;
        return self::$redis_obj -> setex($key , $time , $value);
    }

    /**
     * 模糊查询所有key
     * @param $patt
     * @return array
     */
    public function keys($patt)
    {
        return self::$redis_obj -> keys($patt);
    }

    /**
     * 删除
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        return self::$redis_obj -> delete($key);
    }

    /**
     * 计数加1
     * @param $key
     * @param int $num
     * @return int
     */
    public function incr($key , $num = 1){
        return self::$redis_obj -> incrby($key , $num);
    }

    /**
     * 计数减1
     * @param $key
     * @param int $num
     * @return int
     */
    public function decr($key , $num = 1)
    {
        return self::$redis_obj -> decrBy($key , $num);
    }

    public function setname($n){ $this->name = $n; }
    public function getname(){ return $this->name; }
}