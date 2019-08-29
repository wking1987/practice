<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/1
 * Time: 17:22
 */
$token = 'adfiejaldkfa';
header('Data-token: ' . $token);
echo __FILE__;
echo "<br/>";
$post = $_REQUEST;
print_r($post);