<?php
/**
 *  进程队列通信
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 11:44
 */

$workers = [];
$woker_num = 2;
//1、批量 创建进程
for ($i = 1 ; $i <= $woker_num ; $i ++){
    //创建子进程
    $process = new swoole_process("doProcess" , false , false);
    //开启当前子进程的队列，类似于全局函数
    $process->useQueue();
    $pid = $process->start();
    $workers[$pid] = $process;
}

//2、进程执行函数
/**
 * @param swoole_process $worker    子进程资源
 */
function doProcess(swoole_process $worker){
    //获取数据，默认8192长度
    $receive = $worker->pop();
    echo "从主进程获取到的数据：" . $receive . "\n";
    sleep(5);
    //退出进程
    $worker->exit(0);
}

//3、主进程 向子进程添加数据
foreach($workers as $pid => $process){
    $str = "hello 子进程:" . $pid . "\n";
    echo "向子进程写入数据：" . $str;
    $process->push($str);
}

//4、等待子进程结束，回收资源
for($i = 1 ; $i <= $woker_num ; $i ++){
    //等待执行完成
    $ret = swoole_process::wait();
    $pid = $ret['pid'];
    //删掉进程池数组
    unset($workers[$pid]);
    echo "子进程退出而：" . $pid . "\n";
}

/**
 *  主进程就是当前运行的php文件
 *  子进程就是$workers里的每个process
 *  第 3 步的向子进程添加数据，就是运行此php文件脚本，向$workers中的每个process写入数据
 *  当向子进程写入数据时，会触发子进程执行事件，执行第 2 步定义的回调函数
 */