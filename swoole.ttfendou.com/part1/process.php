<?php
/**
 * 创建进程
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 11:10
 */


//进程对应的执行函数
function doProcess(swoole_process $worker){
    //打印进程编号
    echo "PID:" . $worker->pid . "\n";
    sleep(10);
}

//创建进程：第一个
$process = new swoole_process("doProcess");
$pid = $process->start();
var_dump($pid);

//创建进程：第二个
$process = new swoole_process("doProcess");
$pid = $process->start();
var_dump($pid);

//创建进程：第三个
$process = new swoole_process("doProcess");
$pid = $process->start();
var_dump($pid);

//等待结束，不设置容易出现僵尸进程
swoole_process::wait();

//在服务器执行PHP文件后，用命令ps -ajft 可查看到进程
