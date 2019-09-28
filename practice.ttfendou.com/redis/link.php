<?php
use Workerman\Worker;
use lib\LibUtilClass;
use lib\LibConnectClass;
use lib\LibUserClass;
$workAutoLoad = '../Workerman/Autoloader.php';
require_once $workAutoLoad;
include_once './common/page.php';
include_once './lib/LibUtilClass.php';
include_once './lib/LibConnectClass.php';
include_once './lib/LibUserClass.php';

// 创建一个Worker监听2345端口，使用http协议通讯
$worker = new Worker("websocket://0.0.0.0:2345");

// 启动4个进程对外提供服务
$worker->count = 1;

function handle_onWorkerStart($connection)
{
    $utilObj = LibUtilClass::clearUser();
    $utilObj = LibUtilClass::clearCount();
}

function handle_onConnect($connection)
{

}
// 接收到浏览器发送的数据时回复hello world给浏览器
function handle_onMessage($connection, $data)
{
    global $worker;
    $infoData = LibUtilClass::handleWorkermanString($data);
    LibUtilClass::writeLog("[" . $data . "]" , 'worker');
    if($infoData['status'] > 0)
    {
        $handleResult = LibUtilClass::handleWs($infoData['info']);
        if($infoData['info']['type'] == 'open')
        {
            $connection->send(date("Y-m-d H:i:s|" , time()) . 'hello ' . $infoData['info']['name']);
        }elseif($infoData['info']['type'] == 'leave')
        {
            $connection->send(date("Y-m-d H:i:s|" , time()) . 'good by ' . $infoData['info']['name']);
        }
        print_r($handleResult);

        if($handleResult['send_type'] == 'all')
        {
            foreach($worker -> connections as $con)
            {
                $con -> send($handleResult['content']);
            }
        }elseif($handleResult['send_type'] == 'one'){
            $connection -> send($handleResult['content']);
        }
    }
};

/*function handle_onClose($connection)
{
    global $worker;
    $count_user = LibUtilClass::reduceCount();
    foreach($worker -> connections as $con)
    {
        $con -> send('当前在线' , $count_user . '人');
    }
}*/
$worker -> onWorkerStart = 'handle_onWorkerStart';
$worker -> onMessage = 'handle_onMessage';
$worker -> onConnect = 'handle_onConnect';
//$worker -> onClose = 'handle_onClose';
// 运行worker
Worker::runAll();