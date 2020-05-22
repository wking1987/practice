<?php
/**
 * Created by wking
 * Date: 2019/12/5
 * Time: 9:53
 */

class Register
{
    public static function getConnection()
    {
        return 'this is static getConnection';
    }
}

class SomeComponent
{
    protected $_connection;
    public function setConnection($connection)
    {
        $this->_connection = $connection;
    }

    public function someDbTask()
    {
        echo $this->_connection;

    }
}

$some = new SomeComponent();
$some->setConnection(Register::getConnection());
$some->someDbTask();