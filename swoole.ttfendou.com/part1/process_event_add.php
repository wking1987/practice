<?php
/**
 *  进程事件
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 11:24
 */

//pid:process_id，进程编号

//进程池
$workers = [];
//进程的数量
$worker_num = 3;
//1、创建并启动进程
for($i = 1 ; $i <= $worker_num ; $i ++){
    //创建单独的新进程
    $process = new swoole_process("doProcess");
    //启动进程并获取进程id
    $pid = $process->start();
    //存入进程池数组
    $workers[$pid] = $process;
}

//2、创建进程回调函数
/**
 * @param swoole_process $worker    子进程资源
 */
function doProcess(swoole_process $worker) {
    //子进程写入信息到管道
    $worker->write("PID:" . $worker->pid . ",time:" . date("Y-m-d H:i:s") . "\n");
    echo "写入信息:" . $worker->pid . "  " . $worker->callback . "\n";
    print_r($worker);
    echo "\n";
}

//3、添加进程事件 向每一个子进程添加需要执行的动作
foreach($workers as $process){
    //添加
    swoole_event_add($process->pipe , function($pipe) use ($process){
        //读取数据
        $data = $process->read();
        echo "接收到的数据：" . $data . "\n";
        echo "[{$pipe}]";
        echo "\n";
    });
}

/**
 *  主进程就是当前运行的php文件
 *  子进程就是$workers里的每个process
 *  第 2 步定义好了每次有子进程被触发时要做的操作
 *  第 3 步向每个子进程执行事件添加，会在第 2 步的回调函数中往子进程中写入数据，然后再通过process->read()读取出来
 */