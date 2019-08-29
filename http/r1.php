<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/8
 * Time: 17:43
 */
header("Content-Type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Shanghai");
include_once './class/http.class.php';
//$url = 'http://www.wk.com/httptest/default.jpg';
$url = 'http://imgsrc.baidu.com/forum/w%3D580%3B/sign=b0eabddea1c379317d688621dbffb645/a8014c086e061d95c26148e075f40ad163d9cac7.jpg';
$url = 'https://imgsa.baidu.com/forum/pic/item/a4c27d1ed21b0ef455b1d055d7c451da81cb3e5b.jpg';
$url = 'http://imgsrc.baidu.com/forum/w%3D580%3B/sign=641330d90455b3199cf9827d73928026/6f061d950a7b0208b02443396cd9f2d3562cc87d.jpg';
//$url = 'http://www.wk.com/httptest/files/111.html';
//$url = 'http://www.wk.com/httptest/files/222.txt';
$url = 'http://www.wk.com/httptest/111.png';
$url = 'https://item.jd.com/100001236620.html';
$url = 'http://www.idongjia.cn/gw/view/jobs.html';
$url = 'https://item.m.jd.com/ware/view.action?wareId=1887526';
//$url = 'https://item.taobao.com/item.htm?spm=a310p.7395781.1998038982.1&id=536209306156';
//$url = 'https://gd2.alicdn.com/imgextra/i2/1014474161/TB2jyebXFrB11BjSspjXXciYpXa_!!1014474161.jpg';
var_dump($url);
/*$con = file_get_contents($url);
echo "<textarea cols='200' rows='50'>";
echo $con;
exit;*/
$http = new HttpSock($url);
//Referer: https://tieba.baidu.com/f?kw=%E5%8E%86%E5%8F%B2
$header = array(
    'Referer' => 'https://www.qq.com/f?kw=%E5%8E%86%E5%8F%B2',
);
$http->setHeader($header);
$result = $http->get();
var_dump('读取的数据');
echo "<textarea cols='200' rows='50'>";
print_r($result);
echo "</textarea>";

//文件保存的类型
$ext = $http->getResType();
$filename = './download/' . date("YmdHis") . rand(1000 , 9999) . '.' . $ext;
file_put_contents($filename , $result);
var_dump('数据头信息');
echo "<textarea cols='200' rows='20'>";
print_r($http->getResLine());
print_r($http->getResHeader());
echo "</textarea>";
exit;

//文件保存的类型
$ext = '';
$filename = './download/' . date("YmdHis") . rand(1000 , 9999) . '.' . $ext;


