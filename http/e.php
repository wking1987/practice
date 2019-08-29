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
echo "POST:<br/>";
$post = $_POST;
print_r($post);
echo "<hr/>";
echo "GET:<br/>";
print_r($_GET);
echo "<hr/>";
echo "REQUEST:<br/>";
print_r($_REQUEST);