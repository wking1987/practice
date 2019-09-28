<?php
namespace lib;
use lib\LibConnectClass;
use lib\LibUtilClass;
class LibUserClass
{
    private $key_pre = 'user_';
    public function __construct()
    {

    }


    /**
     * 增加用户
     * @param $username
     * @return bool
     */
    public function addUser($username)
    {
        $objRedis = LibConnectClass::getinstance();
        $value = $this -> encode(['open' => 1 , 'qiang' => 0 , 'result' => 0]);
        LibUtilClass::writeLog($username . ":" . $value , 'user');
        $key = $this -> key_pre . $username;
        return $objRedis -> set($key , $value);
    }

    /**
     * 删除用户缓存
     * @param $username
     * @return bool
     */
    public function deleteUser($username)
    {
        $objRedis = LibConnectClass::getinstance();
        LibUtilClass::writeLog('delete:' . $username , 'user');
        $key = $this -> key_pre . $username;
        return $objRedis -> delete($key);
    }

    /**
     * 检查用户是否存在
     * @param $username
     * @return bool
     */
    public function checkUserExists($username)
    {
        $objRedis = LibConnectClass::getinstance();
        $key = $this -> key_pre . $username;
        $resultExists = $objRedis -> exists($key);
        return $resultExists;
    }

    public function clearUser()
    {
        $patt = $this -> key_pre . "*";
        $objRedis = LibConnectClass::getinstance();
        $userList = $objRedis -> keys($patt);
        foreach($userList as $user)
        {
            $objRedis -> delete($user);
        }
    }



    public function encode($info)
    {
        return json_encode($info);
    }
    public function decode($info)
    {
        return json_decode($info , true);
    }
}