<?php
namespace lib;
use lib\LibConnectClass;
use lib\LibUserClass;
class LibUtilClass
{
    private static $countKey = 'count';
    private static $actions = [
        'open',
        'qiang',
        'look',
        'leave',
    ];
    public static function writeLog($content , $filename)
    {
        $filename = trim($filename , '.log');
        if($filename == '')return false;
        $dirLog = WEB_PATH . '/log/';
        $filename = $dirLog . $filename .'-' . date("Ymd",time()). '.log';
        $content = '[' . date("Y-m-d H:i:s" , time()) . ']' . json_encode($content) . "\n";
        if(!file_exists($filename))
        {
            $resultTouch = touch($filename);
            if(!$resultTouch)
            {
                return false;
            }
        }
        $handle = fopen($filename , 'a');
        $result = false;
        if(fwrite($handle , $content)){
            $result = true;
        }
        fclose($handle);
        return $result;
    }

    /**
     * 收到的json字符串转数组
     * @param $string
     * @return array
     */
    public static function handleWorkermanString($string)
    {
        //为空，返回错误
        if(trim($string) == '')return ['status' => 0];
        $arr = json_decode($string , true);
        //不是json格式，返回错误
        if(is_null($arr)) return ['status' => 0];
        $result = ['status' => 1 , 'info' => $arr];
        return $result;
    }

    public static function handleWs($info)
    {
        if(!is_array($info))return false;
        if(!in_array($info['type'] , self::$actions)){
            return [];
        }
        $fun = 'handle_'.$info['type'];
        $result = self::$fun($info);
        return $result;
    }

    public static function handle_open($info)
    {
        $objUser = new LibUserClass();
        $oldCount = self::getCount();
        if(!$objUser -> checkUserExists($info['name']))
        {
            //不存在，则添加用户和计数
            $objUser -> addUser($info['name']);
            self::addCount();
        }
        $count = self::getCount();
        $sendType = $oldCount == $count ? 'one' : 'all';
        $result = ['send_type' => $sendType , 'content' => '用户<font color="red">' . $info['name'] . '</font>上线了，当前在线' . $count . '人'];
        return $result;
    }

    public static function handle_qiang($info)
    {

    }

    public static function handle_leave($info)
    {
        $objUser = new LibUserClass();
        $oldCount = self::getCount();
        if($objUser -> checkUserExists($info['name'])){
            //计数-1
            self::reduceCount();
            //用户缓存下线
            $objUser -> deleteUser($info['name']);
        }
        $count = self::getCount();
        $result = ['send_type' => 'all' , 'content' => '用户<font color="blue">' . $info['name'] . '</font>下线了，当前在线' . $count . '人'];
        return $result;
    }

    /**
     * 添加一个在线人数
     * @return bool|int|string
     */
    public static function addCount()
    {
        $countKey = self::$countKey;
        $redisObj = LibConnectClass::getinstance();
        if(!($redisObj -> exists($countKey))){
            $redisObj -> set($countKey , 1);
            return 1;
        }else{
            $redisObj -> incr($countKey);
            return $redisObj -> get($countKey);
        }
    }

    /**
     * 获取在线人数
     * @return bool|string
     */
    public static function getCount()
    {
        $countKey = self::$countKey;
        $objRedis = LibConnectClass::getinstance();
        return $objRedis -> get($countKey);
    }

    /**
     * 减1
     * @return bool|int|string
     */
    public static function reduceCount()
    {
        $countKey = self::$countKey;
        $redisObj = LibConnectClass::getinstance();
        $returnCount = 0;
        if(!($redisObj -> exists($countKey)))
        {
            $redisObj -> set($countKey , 0);
            $returnCount = 0;
        }else{
            $count = $redisObj -> get($countKey);
            if($count <= 0){
                $redisObj -> set($countKey , 0);
                $returnCount = 0;
            }else{
                $redisObj -> decr($countKey);
                $returnCount = --$count;
            }
        }
        return $returnCount;
    }

    /**
     * 在线人数清零
     */
    public static function clearCount()
    {
        $countKey = self::$countKey;
        $redisObj = LibConnectClass::getinstance();
        $redisObj -> set($countKey , 0);
    }

    public static function clearUser()
    {
        $objUser = new LibUserClass();
        $objUser -> clearUser();
    }

    public static function test()
    {
        $redisObj = LibConnectClass::getinstance();
        echo 'this is a test';
    }

    public static function test2()
    {
        echo 'this is test 2';
    }
}