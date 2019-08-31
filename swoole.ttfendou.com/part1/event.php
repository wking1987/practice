<?php
/**
 *  异步事件
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 16:23
 */

//创建tcp请求
$fp = stream_socket_client("tcp://www.baidu.com:80" , $errorno , $errstr , 30);
//发送请求数据
fwrite($fp , "GET / HTTP/1.1\r\nHost :www.baidu.com\r\n\r\n");
//添加异步事件
swoole_event_add($fp , function($fp){
    $res = fread($fp , 8192);
    var_dump($res);
    swoole_event_del($fp);
    //或者
//    fclose($fp);
});

echo "执行完成\n";

/**
 *  异步调用：不等待返回的调用方式
 */

