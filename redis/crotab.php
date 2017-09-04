<?php
include_once './common/Construct.php';
$redisObj = LibConnectClass::getinstance();
$name = 'name';
$size = $redisObj -> lSize($name);
$result_str = '';
$logFile = date("Ymd" , time()) . '-extract';
if($size == 0)
{
    $result_str = 'no more!';
    $result = LibUtilClass::writeLog('no more!' , $logFile);

    exit;
}
$index = 0;
$max = 30;
$listArr = [];
while($index < $max && $value = $redisObj -> pop($name))
{
    $listArr[] = $value;
    $index++;
}
$resultArr = [
    'list' => $listArr,
    'str' => 'handle ' . $index . ' record',
];
$result = LibUtilClass::writeLog($resultArr , $logFile);

