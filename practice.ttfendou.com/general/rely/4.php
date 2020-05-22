<?php
/**
 * Created by wking
 * Date: 2019/12/5
 * Time: 10:06
 */
class Register
{
    protected static $_connection;

    /**
     *  返回数据库注册
     * @return string
     */
    protected static function _createConnection()
    {
        return 'static connection ：' . microtime(true);
    }

    /**
     *  数据库连接只创建一次并返回
     * @return string
     */
    public static function getSharedConnection()
    {
        if(self::$_connection === null)
        {
            self::$_connection = self::_createConnection();
        }
        return self::$_connection;
    }

    /**
     *  创建新的数据库连接，并返回
     * @return string
     */
    public static function getNewConnection()
    {
        return self::_createConnection();
    }

}

class SomeComponent
{
    protected $_connection;

    public function setConnection($connection)
    {
        $this->_connection = $connection;
    }

    /**
     *  使用共享的数据库连接
     */
    public function someDbTask()
    {
        $connection = $this->_connection;
        echo "<br/>共享的数据库连接<br/>";
        var_dump($connection);
    }

    /**
     *  使用新建的数据库连接
     * @param $connection
     */
    public function someOtherDbTask($connection)
    {
        echo "<br/>新建的数据库连接<br/>";
        var_dump($connection);
    }

}

$some = new SomeComponent();
//设置共享数据库连接
$some->setConnection(Register::getSharedConnection());
$some->someDbTask();
sleep(1);
$some->someDbTask();
sleep(1);
echo '<br/>';
//设置新数据库连接
$some->someOtherDbTask(Register::getNewConnection());
sleep(1);
$some->someOtherDbTask(Register::getNewConnection());