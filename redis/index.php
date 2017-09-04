<?php
include_once './common/Construct.php';

$redisObj = LibConnectClass::getinstance();
$name = 'name';
echo '当前记录总数：' . $redisObj -> lSize($name);

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
