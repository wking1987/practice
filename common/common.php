<?php
use Classes\ConfigClass;
use Classes\PdoClass;
header("Content-type:text/html;charset=utf-8");
if(!defined("ROOT_PATH"))
    define("ROOT_PATH" , "/data/practice");
$file_autoload = ROOT_PATH . "/common/_autoload.php";
$file_config = ROOT_PATH . "/config/config.php";
$file_config_db = ROOT_PATH . "/config/db_config.php";

require_once $file_autoload;
$config_db = require_once $file_config_db;
$config_db = ConfigClass::check_config_db($config_db);
$config = require_once $file_config;

$db = PdoClass::getInstance($config_db);


//$class_db =  __DIR__.'/../Classes/PdoClass.php';
//require_once $class_db;
//$config_db = require_once __DIR__ . '/../config/db_config.php';
//$db = PdoClass::getInstance($config_db);