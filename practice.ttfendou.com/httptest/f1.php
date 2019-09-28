<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/3
 * Time: 15:02
 */

include_once './class/http.class.php';
$url = 'http://www.wk.com/httptest/e.php?name=123';
$url = 'http://suyuan.yuansite.com:8088/home/qrcode/bouns_info';
$http = new HttpSock($url);
$data = array(
    'username' => '追风小子',
    'content' => 'hahahahafefe',
);
$data = array(
    'request_type' => 1,
    'pro_code' => '160p110119082400001',
    'company_id' => 1,
    'sys' => 'h5',
);
//get方式请求，不带数据
//$result = $http->get($data);
//print_r($result);

//post方式请求，带数据
$http->post($data);
$content = $http->getResContent();
echo $content;
echo "<pre>";
print_r(json_decode($content , true));
exit;
var_dump($content);