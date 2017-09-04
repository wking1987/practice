<?php
include_once './common/Construct.php';

$redisObj = LibConnectClass::getinstance();

$size = $redisObj -> lSize('name');
if($size == 0)
{
    echo '没有更多了！';
    exit;
}
var_dump($size);
echo "<hr/>";
$index = 1;
$max = 30;
while($value = $redisObj -> pop('name'))
{
    echo $value."<br/>";
    if($index>=$max)
    {
        echo '名额已满！';
        break;
    }
    $index++;
}

