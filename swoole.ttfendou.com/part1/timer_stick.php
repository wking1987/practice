<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 10:03
 */
//定时器
//创建服务
$swoole_config = [
    'host'  => '0.0.0.0',   //监听地址；0.0.0.0表示全部的地址
    'port'  => '9501',
];
//循环执行
swoole_timer_tick(2000 , function($timer_id){
    echo "循环执行:" . $timer_id . '。时间：' . date("Y-m-d H:i:s");
    echo "\n";
});

//单次执行
swoole_timer_after(3000 , function(){
    echo "单次执行\n";
});