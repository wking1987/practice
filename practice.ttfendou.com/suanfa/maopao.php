<?php
/**排序算法之冒泡排序
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26
 * Time: 2:01
 */

include_once './SuanfaClass.php';
$arr = [];
$length = $_GET['l'] ? $_GET['l'] : 10;
for($i = 1 ; $i <= $length ; $i ++)
{
    $arr[] = rand(-1000 , 1000);
}
$arr = Array
(
    0 => 100,
    1 => 100,
    2 => 1001,
    3 => 100,
    4 => 100,
//    5 => 952,
//    6 => 747,
//    7 => 683,
//    8 => 190,
//    9 => 818,
);
echo "排序前数组为：<br/>";
echo "<pre>";
print_r($arr);
echo "</pre>";
$arr_sort = SuanfaClass::zhijie($arr , 'asc');
echo "<br/>排序后数组为：<br/>";
echo "<pre>";
print_r($arr_sort);
echo "</pre>";

