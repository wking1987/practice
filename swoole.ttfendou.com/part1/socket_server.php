<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 9:06
 */

//创建WebSocket 服务
//继承自swoole_http_server
$swoole_config = [
    'host'  => '0.0.0.0',   //监听地址；0.0.0.0表示全部的地址
    'port'  => '9501',
];
$ws = new swoole_websocket_server($swoole_config['host'] , $swoole_config['port']);

/**
 *  open：建立或打开链接    $ws(服务器)    $request(客户端信息)
 */
$ws->on('open' , function($ws , $request){
//    print_r($request);
    $ws->push($request->fd , "welcom \n");
});

/**
 *  message 接受信息
 */
$ws->on('message' , function($ws , $request){
    echo "Message:" . $request->data . "\n";
    echo "fd:" . $request->fd;
    $ws->push($request->fd , "get message \n");
});

/**
 *  close  关闭
 */
$ws->on('close' , function($ws , $request){
    echo "close \n";
});

$ws->start();

