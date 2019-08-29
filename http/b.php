<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/1
 * Time: 11:23
 */

$post = $_POST;
$filename = './writelogs/' . date("YmdHis") . '.txt';
if(empty($post))
    exit('content empty');

$post = json_encode($post);
$result = false;
if(!empty($post))
    $result = file_put_contents($filename , $post);
echo $post ? 'write success' : 'write fail';
