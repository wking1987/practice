<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/29
 * Time: 18:21
 */
include_once 'common.php';
//创建WEB服务，继承自swoole_server
$swoole_config = [
    'host'  => '0.0.0.0',   //监听地址；0.0.0.0表示全部的地址
    'port'  => '9501',
];

$server = new swoole_http_server($swoole_config['host'] , $swoole_config['port']);

$server->on('start'  , function($server){
    echo 'Http Server has start ' . date("Y-m-d H:i:s" , time());
    echo "\n";
});

/**
 *  $request：请求信息，包括get，post等
 *  $response:  返回信息
 */
$server->on('request' , function($request , $response){
    print_r($request);
    echo "\n";
    //设置返回头信息
    $response->header("Content-Type" , "text/html;charset=utf-8");
    //设置返回内容
    $response->end("hello-" . date("Y-m-d H:i:s" , time()));
});

$server->start();

//浏览器访问 http://47.98.121.135:9501