<?php
include_once './common/Construct.php';

$redisObj = LibConnectClass::getinstance();

//97-122
for($i=101;$i<=200;$i++)
{
    $str = '';
    for($j=1;$j<=10;$j++)
    {
        $index = rand(97,122);
        $str .= chr($index);
    }
    $str .= str_pad($i,2,"0",STR_PAD_LEFT);
    echo $str;
    echo "<hr/>";
    $redisObj -> push('name' , $str);
}
//var_dump($redisObj -> pop('name'));