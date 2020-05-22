<?php
/**
 * Created by wking
 * Date: 2019/12/5
 * Time: 8:57
 */
class SomeComponent
{
    public function someDbTask()
    {
        $connection = 'this is db_connection';
        echo $connection;
    }

    //................
}

$some = new SomeComponent();
$some->someDbTask();