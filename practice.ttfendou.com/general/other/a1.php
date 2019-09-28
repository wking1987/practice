<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/29
 * Time: 16:15
 */
$a = [0,1,2,3];
$b = [1,2,3,4,5];
$a += $b;
echo json_encode($a);
//[0,1,2,3,5]
