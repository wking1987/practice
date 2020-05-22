<?
echo __FILE__;exit;
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->lpush("tutorial-list", "Redis");
$redis->lpush("tutorial-list", "Mongodb");
$redis->lpush("tutorial-list", "Mysql");
$redis->lpush("tutorial-list", "A");
$redis->lpush("tutorial-list", "B");
$redis->lpush("tutorial-list", "C");
$redis->lpush("tutorial-list", "D");
$redis->lpush("tutorial-list", "Mysql");

$redis->lPush("user" , 'tom');
$redis->lPush("user" , 'jerry');
$redis->lPush("user" , 'henry');
$redis->lPush("user" , 'lili');

for($i=1;$i<5;$i++)
{
    echo date("Y-m-d H:i:s" , time());
    echo "\n";
    sleep(2);
}
exit;
$redis -> set('string' , 'hello word');

if(!$redis -> get('time')){
    $redis -> setex('time' , 10 , time());
    echo "set\n";
}else{
    echo $redis -> get('time');
    echo "\n";
    $redis -> incr('time' , 1);
    echo "\n";
    echo $redis -> get('time');
    echo "\n";
    echo $redis -> ttl('time');
    echo "\n";
}

var_dump($redis -> exists('time'));


$list = $redis -> lRange('tutorial-list' , 0 , 20);

$keys = $redis -> keys('tutorial-list');

$get = $redis -> get('string');
var_dump($get);
?>
