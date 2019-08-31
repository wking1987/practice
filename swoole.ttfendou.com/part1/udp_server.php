<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/29
 * Time: 17:58
 */
//创建UDP服务
include_once 'common.php';

$swoole_config = [
    'host'  => '0.0.0.0',
    'port'  => '9502',
    'mode'  => SWOOLE_PROCESS,    //多进程模式，非必填
    'sock_type' => SWOOLE_SOCK_UDP,   //UDP类型
];

$server = new swoole_server($swoole_config['host'] , $swoole_config['port'] , $swoole_config['mode'] , $swoole_config['sock_type']);

//监听数据接收的时间
/**
 *  $server 服务器信息
 *  $data   接收到的数据
 *  $fd     客户端信息
 */
$server->on('packet' , function($server , $data , $fd){
    //发送数据到响应的客户端，反馈信息
    $server->sendto($fd['address'] , $fd['port'] , "Server:" . $data);
    print_r($fd);
});

$server->start();
