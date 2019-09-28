<?php
use lib\LibConnectClass;
use lib\LibGoodsClass;
use lib\LibUtilClass;
use lib\LibRedisClass;
include_once './common/Construct.php';

$objRedis = LibConnectClass::getinstance();

$name = 'name';
echo '当前记录总数：' . $objRedis -> lSize($name);
echo '<br/>';
$keyCount = 'count';
echo '当前在线人数:' . $objRedis -> get($keyCount);
?>
<html>
<head></head>
<body>
<br/>
<a href="http://practice.ttfendou.com/redis/push.php" target="_blank">加记录</a>
<br/>
<a href="http://practice.ttfendou.com/redis/extract.php" target="_blank">抽取记录</a>

</body>
</html>
