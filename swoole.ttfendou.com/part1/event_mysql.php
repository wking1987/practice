<?php
/**
 *  异步MySQL操作
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 16:37
 */

$config = [
    'host' => '127.0.0.1',
    'user' => 'swoole_test',
    'port' => 3306,
    'password' => 'jMrEDsxfifBzLrL4',
    'database' => 'swoole_test',
    'charset' => 'utf8',
];
//旧版本
/*$db = new swoole_mysql();

//链接数据库。$db是new的对象，$res是返回结果
$db->connect($config , function($db , $res){
    if($res == false){
        var_dump($db->connect_errno , $db->connect_error);
        die("链接失败！");
    }
    //成功逻辑
    $sql = 'SELECT * FROM table1';
    $db->query($sql , function(swoole_mySQL $db , $qres){
        if($qres === false){
            var_dump($db->errno , $db->error);
            die("查询失败！");
        }elseif($qres === true){
            echo "查询结果：\n";
            var_dump($db->affected_rows , $db->insert_id);
        }

        $db->close();
    });
});*/


/*$swoole_mysql = new Swoole\Coroutine\MySQL();
$swoole_mysql->connect([
    'host' => '172.16.95.255',
    'port' => 3306,
    'user' => 'swoole_test',
    'password' => 'jMrEDsxfifBzLrL4',
    'database' => 'swoole_test',
]);
$res = $swoole_mysql->query($sql , function(swoole_mysql $swoole_mysql , $res){
    var_dump($res);
});*/

//4.4版本，且只能通过cli方式编译
go(
    function () {
        $db = new Co\MySQL();
//        $server = array( 'host' => 'XXXX', 'port' => 3306, 'user' => 'root', 'password' => 'XXXX', 'database' => 'swoole', );
        $server = [
            'host' => '127.0.0.1',
            'user' => 'swoole_test',
            'port' => 3306,
            'password' => 'jMrEDsxfifBzLrL4',
            'database' => 'swoole_test',
            'charset' => 'utf8',
        ];
        $db->connect($server);
        $sql = 'SELECT * FROM table1';
        $result = $db->query($sql);
        print_r($result);
});
