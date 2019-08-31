<?php
/**
 *  锁机制
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 15:35
 */

//创建锁对象
/**
 *  1 文件锁 SWOOLE_FILELOCK
 *  2 读写锁 SWOOLE_RWLOCK
 *  3 信号量 SWOOLE_SEM
 *  4 互斥锁 SWOOLE_MUTEX
 *  5 自旋锁 SWOOLE_SPINLOCK
 */
$lock = new swoole_lock(SWOOLE_MUTEX);

echo "创建互斥锁\n";

//开始锁定主进程
$lock->lock();

//pcntl_fork()创建子进程
$pid = pcntl_fork();
if($pid > 0){
    echo "子进程id：" . $pid . "\n";
    sleep(3);
    echo "解锁\n";
    //解锁操作
    $lock->unlock();
}else{
    echo "子进程等待锁...\n";
    $lock->lock();
    echo "子进程获取锁\n";
    //释放锁
    $lock->unlock();
    //子进程退出
    exit("子进程退出...\n");
}

echo "主进程释放锁\n";
unset($lock);

sleep(3);
echo "子进程也退出\n";

/**
 *  运行结果
 *
创建互斥锁
子进程id：1051
子进程等待锁...
解锁
主进程释放锁
子进程获取锁
子进程退出...
子进程也退出
 *
 */



