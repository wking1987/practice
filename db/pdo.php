<?php
require_once('../func.php');
require_once('../Classes/PdoClass.php');

$pdo = new PdoClass();

echo "<pre>";
$list1 = $pdo -> test_unuserfull_tag();
dump($list1);





exit;
$config_db = [
    'mysql' => [
        'dbms' => 'mysql',
        'host' => '127.0.0.1',
        'dbname' => 'phpwind9',
        'user' => 'root',
        'password' => '',
        'dsn' => 'mysql:host=localhost;dbname=phpwind9',
    ],

];

dump(123);

try{
    $dbh = new PDO($config_db['mysql']['dsn'] , $config_db['mysql']['user'] , $config_db['mysql']['password']);

}catch (PDOException $e)
{
    die("Error:" . $e -> getMessage() . "<br/>");
}

echo "<pre>";

//带输出参数调用存储过程
$stmt = $dbh->prepare("CALL sp_returns_string(?)");

$stmt->bindParam(1, $return_value, PDO::PARAM_STR, 4000);

// 调用存储过程
$stmt->execute();

print "procedure returned $return_value\n";
exit;

//预处理语句重复插入
//用name和value替代相应的命名占位符来执行一个插入
$stmt_insert_1 = $dbh -> prepare('INSERT INTO `pw_user` (username,email,regdate) VALUES (:username,:email,:regdate)');
$stmt_insert_1 -> bindParam(":username" , $username1);
$stmt_insert_1 -> bindParam(":email" , $email1);
$stmt_insert_1 -> bindParam(":regdate" , $regdate1);
$username1 = 'wk' . rand(1000,9999);
$email1 = rand(1000,9999) . '@123.com';
$regdate1 = time();
$result_insert_1 = $stmt_insert_1 -> execute();
var_dump($result_insert_1);
exit();

//用问号 ? 来替代相应的字段名作为占位符来执行一个插入
$stmt_insert_2 = $dbh -> prepare('INSERT INTO `pw_user` (username,email,regdate) VALUES (?,?,?)');
$stmt_insert_2 -> bindParam("1" , $username2);
$stmt_insert_2 -> bindParam("2" , $email2);
$stmt_insert_2 -> bindParam("3" , $regdate2);
$username2 = 'wk' . rand(1000,9999);
$email2 = rand(1000,9999) . '@123.com';
$regdate2 = time();
$result_insert_2 = $stmt_insert_2 -> execute();
var_dump($result_insert_2);
exit();

//用预处理语句获取数据
//用字段名最为占位符
$stmt_select1 = $dbh -> prepare('SELECT * FROM `pw_user` WHERE `username`=:username');
$where_arr1 = [
    ':username' => 'wk1',
];
//用问号 ? 作为占位符
$stmt_select1 = $dbh -> prepare('SELECT * FROM `pw_user` WHERE `username`=?');
$where_arr1 = [
    'wk1',
];
if($stmt_select1 -> execute($where_arr1))
{
    while($row = $stmt_select1 -> fetchAll(PDO::FETCH_ASSOC))
    {
        print_r($row);
    }
}

exit();

$result = $dbh->query('SELECT * from pw_user');
while ($row = $result -> fetch(PDO::FETCH_ASSOC)) {
    print_r($row); //你可以用 echo($GLOBAL); 来看到这些值
//        print_r($GLOBALS) ;
}
$dbh = null;