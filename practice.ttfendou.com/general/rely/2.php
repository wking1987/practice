<?php
/**
 * Created by wking
 * Date: 2019/12/5
 * Time: 9:23
 */
class SomeComponent
{
    protected $_connection;
    public function setConnection($connection)
    {
        $this->_connection = $connection;
    }

    public function someDbTask()
    {
        $connection = $this->_connection;
        var_dump($connection);
        echo 'some connection';
        //......

    }
}

$connection = 'this is db_connection';
$some = new SomeComponent();
$some->setConnection($connection);
$some->someDbTask();