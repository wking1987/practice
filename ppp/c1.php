<?php
/**
 * Created by wk
 * Since: 2018/5/17 9:01
 */

class c1
{
    public function __call($name , $params)
    {
        echo $name;
        echo "<br/>";
        var_dump($params);
        exit;
    }
}

$obj1 = new c1();
$obj1 -> name('tom' , '20' , 'male');