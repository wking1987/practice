<?php
if(!defined("WEB_PATH")){
    define("WEB_PATH" , '/data/practice/redis');
}
//$fileAutoload = './common/_autoload.php';
$fileAutoload = WEB_PATH . '/common/_autoload.php';
include_once ($fileAutoload);
$fileConfig = WEB_PATH . '/config/ConfigBaseClass.php';
include_once $fileConfig;
//include_once './config/ConfigBaseClass.php';