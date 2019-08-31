<?php
/**
 *  异步TCP客户端
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 11:00
 */

$swoole_config = [
    'host'  => '0.0.0.0',   //监听地址；0.0.0.0表示全部的地址
    'port'  => '8080',
    'mode'  => SWOOLE_PROCESS,    //多进程模式，非必填
    'sock_type' => SWOOLE_SOCK_TCP,   //TCP是默认方式，非必填
];

//创建异步TCP客户端
$client = new swoole_client(SWOOLE_SOCK_TCP , SWOOLE_SOCK_ASYNC);

//注册链接成功的回调函数
$client->on("connect" , function($cli){
    $cli->send("hello world\n");
});

//注册数据接收    $cli：服务端信息，其中的$data就是数据
$client->on("receive" , function($cli , $data){
    echo "data:" . $data;
});

//注册链接失败
$client->on("error" , function($cli){
    echo "失败\n";
});

$client->on("close" , function($cli){
    echo "关闭\n";
});

//发起链接
$client->connect($swoole_config['host'] , $swoole_config['port']);