<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/8
 * Time: 23:15
 */
session_start();
//$_SESSION['filename'] = __FILE__;
//$_SESSION['name'] = 'tom';
$memcached = new Memcached();
$memcached -> addServer('127.0.0.1' , 11211) or die('Can not connect memcache');
//$memcached -> set('my' , 'haha' . time() , 10) or die('Can not set memcache');
//$memcached -> delete('my');
$my = $memcached -> get('my');
if($my != '')
{
    echo "memcache=" . $memcached -> get('my');
}else{
    echo time();
}

echo "<pre>";
var_dump($_SESSION);
echo __FILE__;
echo "</pre><br/>";
var_dump(session_id());
