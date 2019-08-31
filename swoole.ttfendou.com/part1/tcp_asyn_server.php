<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 10:20
 */
//异步tcp服务
include_once 'common.php';

$swoole_config = [
    'host'  => '0.0.0.0',   //监听地址；0.0.0.0表示全部的地址
    'port'  => '9501',
];
//创建TCP服务器
$server = new swoole_server($swoole_config['host'] , $swoole_config['port']);


//设置异步 进程工作数
$set = [
    'task_worker_num' => 4,
];
$server->set($set);

//投递异步任务
$server->on('receive' , function($server , $fd , $reactor_id , $data){
    //异步ID
    $task_id = $server->task("Async");
    echo "异步ID：" . $task_id . "\n";
});

//处理异步任务
$server->on("task" , function($server , $task_id , $from_id , $data) {
    echo "执行异步ID：" . $task_id . "\n";
    echo "接到任务时间：" . date("Y-m-d H:i:s") . "\n";
    $server->finish("$data -> OK");
    //延时执行操作
    /*swoole_timer_after(3000 , function() use ($server , $data){
        $server->finish("$data -> OK");
    });*/

});

//处理结果
$server->on("finish" , function($server , $tark_id , $data){
    echo "执行完成[" . $tark_id . "]时间：" . date("Y-m-d H:i:s") . "\n";
});

$server->start();
