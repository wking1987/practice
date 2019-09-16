<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/9/11
 * Time: 10:48
 */

class BaseProcess
{
    private $process;

    public function __construct()
    {
        /**
         *  callable $function 子进程创建成功后要执行的函数
         *  bool $redirect_stdin_stdout 重定向子进程的标准输入和输出
         *  int $pipe_type = SOCK_DGRAM 管道类型,1或true表示开启管道
         */
        $this->process = new swoole_process(array($this , 'run') , false , true);

        $this->process->start();

        //异步在管道中读取数据并处理
        swoole_event_add($this->process->pipe , function ($pipe) {
            $data = $this->process->read();
            echo "RECV:" . $data . PHP_EOL;
        });
    }

    public function run($worker)
    {
        //定时器，每秒中向管道中写入数据
        swoole_timer_tick(10 , function ($timer_id) {
            static $index = 0;
            $index ++;
            $this->process->write('Hello');
            if($index >= 10){
                swoole_timer_clear($timer_id);
            }
        });
    }
}

new BaseProcess();
swoole_process::signal(SIGCHLD , function ($sig) {
    //必须为false，非阻塞模式
    while($ret = swoole_process::wait(false)){
        echo "PID={$ret['pid']}\n";
    }
});
