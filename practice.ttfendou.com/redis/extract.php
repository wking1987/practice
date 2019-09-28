<?php
include_once './common/Construct.php';

$redisObj = LibConnectClass::getinstance();
$name = 'name';

$size = $redisObj -> lSize($name);
if($size == 0)
{
    echo '没有更多了！';
    exit;
}
var_dump($size);
echo "<hr/>";
$index = 0;
$max = 30;
while($index < $max &&$value = $redisObj -> pop($name))
{
    echo $value."<br/>";
    $index++;
}

