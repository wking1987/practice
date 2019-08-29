<?php
use a\classNameA;
use b\classNameB;
include_once 'al.php';
$dObj = new \classNameD();
$dObj -> get_a();
echo "<hr/>";
$aObj = new classNameA();
$aObj -> showa();
echo "<hr/>";
$bObj = classNameB::getinstance();
var_dump($bObj);