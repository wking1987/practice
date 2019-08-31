<?php
/**
 *  简单聊天
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 17:35
 */

require_once "./function.php";
$swoole_config = [
    'host'  => '0.0.0.0',   //监听地址；0.0.0.0表示全部的地址
    'port'  => '9501',
];
//创建websocket服务
$ws = new swoole_websocket_server($swoole_config['host'] , $swoole_config['port']);

$ws->on("open" , function($ws , $request){
    echo "新用户：" . $request->fd . " 加入\n";
    //设置登录用户
    set_user(['id' => $request->fd , 'name' => rand(100 , 999)]);
});

//收发消息
$ws->on("message" , function($ws , $request){
    $user_list = get_user_list();
    $msg = $user_list[$request->fd]['name'] . ":" . $request->data . "\n";
    if(strstr($request->data , "#name#")){
        //用户设置昵称
        $name = str_replace("#name#" , '' , $request->data);
        set_user(['id' => $request->fd , 'name' => $name]);
        echo "用户设置昵称为：" . $name . "\n";
    }else{
        //用户信息发送
        echo $msg;
        //发送到每一个客户端
        foreach($user_list as $key => $value){
            $ws->push($value['id'] , $msg);
        }
    }
});

$ws->on("close" , function($ws , $request){
    $user_list = get_user_list();
    $msg = "用户：" . $user_list[$request->fd]['name'] . "下线了！";
    echo $msg . "\n";
    //清除用户
    delete_user(['id' => $request]);
    /*foreach($GLOBALS['fd'] as $key => $value){
        if($value['id'] == $request->fd)
            continue;
        $ws->push($value['id'] , $msg);
    }*/

});

$ws->start();