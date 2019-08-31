<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/29
 * Time: 17:43
 */
include_once 'common.php';

//创建TCP服务
$swoole_config = [
    'host'  => '0.0.0.0',   //监听地址；0.0.0.0表示全部的地址
    'port'  => '9501',
    'mode'  => SWOOLE_PROCESS,    //多进程模式，非必填
    'sock_type' => SWOOLE_SOCK_TCP,   //TCP是默认方式，非必填
];
$server = new swoole_server($swoole_config['host'] , $swoole_config['port']);

//使用
// bool $swoole_server->on(string $event , mixed $callback);
/**
 *  $event
 *  connect:当建立连接的时候；默认的参数有两个 $server(服务器信息) $fd(客户端信息)
 *  receive:当接收到数据；三个参数 $server(服务器信息) $fid(客户端信息)  $from_id(客户端信息ID) $data(传递的数据)
 *  close:当关闭连接
 */
$server->on('connect' , function($server , $fd){
    echo "connect success\n";
    print_r($fd);
    echo "\n";
});

$server->on('receive' , function($server , $fd , $from_id , $data){
    echo "receive data\n";
    print_r($data);
    echo "\n";
});

$server->on('close' , function($server , $fd){
    echo "close\n";
});


//启动服务器
$server->start();

//在Linux服务中打开对应目录，执行# php tcp_server.php
//查看是否正在执行 # ps -ajft
//进程中会包含index.php的进程和子进程
//用网络调试助手，进行tcp调试