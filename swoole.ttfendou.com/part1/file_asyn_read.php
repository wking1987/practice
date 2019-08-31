<?php
/**
 *  异步读取文件
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 16:08
 */
/*use Swoole\Async;
//方式1：纯函数
$filename = __DIR__ . 'common.php';
swoole_async_readfile($filename , function($filename , $content){
    echo "filename:" . $filename . "\n";
    echo "content:" . $content . "\n";
});

//方式2：对象方式
Swoole\Async::readfile($filename , function($filename , $content){
    echo "filename:" . $filename . "\n";
    echo "content:" . $content . "\n";
});*/

use Swoole\Coroutine\System;
/*$filename = __DIR__ . "/defer_client.php";
go(function () use ($filename)
{
    $r =  System::readFile($filename);
    var_dump($r);
});*/

$fp = fopen(__DIR__ . "/defer_client.php", "r");
go(function () use ($fp)
{
    fseek($fp, 256);
    $r =  System::fread($fp);
    var_dump($r);
});

/**
 *  上边几个都没有实验成功
 *  Swoole\Coroutine\System 模块在4.4.4版本可用
 */