<?php
/**
 *  TCP客户端
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 10:51
 */

$swoole_config = [
    'host'  => '192.168.1.1',   //监听地址；0.0.0.0表示全部的地址
    'port'  => '8080',
    'mode'  => SWOOLE_PROCESS,    //多进程模式，非必填
    'sock_type' => SWOOLE_SOCK_TCP,   //TCP是默认方式，非必填
];
//创建TCP客户端
$client = new swoole_client($swoole_config['sock_type']);

//链接服务器
$client->connect($swoole_config['host'] , $swoole_config['port'] , 5) or die("链接失败！");

//向服务器发送数据
$client->send("hello word") or die("数据发送失败！");

//服务器接收数据

$data = $client->recv();
if(empty($data)){
    echo "接收失败！\n";
}else{
    echo $data . "\n";
}
//关闭客户端
$client->close();