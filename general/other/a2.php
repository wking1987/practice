<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/9/11
 * Time: 10:41
 */

function loop_test(){
    static $index = 0;
    $index ++;
    echo $index . "<br/>";
}

class test1{
    protected static $index = 1;
    public function show(){
        echo self::$index ++;
        echo "<br/>";
    }
}

$test1 = new test1();
for($i = 1 ; $i <= 10 ; $i ++){
    $test1 -> show();
}

$test2 = new test1();
for($j = 1 ; $j <= 10 ; $j ++){
    $test2 -> show();
}

exit;
for($i = 1 ; $i <= 10 ; $i ++){
    loop_test();
}