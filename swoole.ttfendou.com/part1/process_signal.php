<?php
/**
 *  进程信号触发
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 15:20
 */
/*use Swoole\Process;

Process::signal(SIGALRM, function () {
    static $i = 0;
    echo "#{$i}\talarm\n";
    $i++;
    if ($i > 20) {
        Process::alarm(-1);
    }
});

//100ms
Process::alarm(100 * 1000);
var_dump(swoole_errno());
echo "\n";*/

//触发函数  异步执行  达到10次挺尸
swoole_process::signal(SIGALRM , function(){
    static $i = 0;
    echo $i . "\n";
    $i ++;
    if($i > 10){
        //清除定时器
        swoole_process::alarm(-1);
    }
});

//定时信号：时间级别是微妙。100 * 1000 是100毫秒，是0.1秒
swoole_process::alarm(100 * 1000);

/**
 *  每100毫秒，触发一次触发函数
 *  实验未成功
 */



