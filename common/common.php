<?php
use Classes\ConfigClass;
use Classes\PdoClass;
header("Content-type:text/html;charset=utf-8");
if(!defined("ROOT_PATH")) {
    $root_path = str_replace(DIRECTORY_SEPARATOR . 'common' , '' , __DIR__);
    define("ROOT_PATH" , $root_path);
}
$file_autoload = ROOT_PATH . DIRECTORY_SEPARATOR . "common" . DIRECTORY_SEPARATOR . "_autoload.php";
$file_config = ROOT_PATH . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.php";
$file_config_db = ROOT_PATH . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "db_config.php";
require_once $file_autoload;
$config_db = require_once $file_config_db;
$config_db = ConfigClass::check_config_db($config_db);
$config = require_once $file_config;

$db = PdoClass::getInstance($config_db);


//$class_db =  __DIR__.'/../Classes/PdoClass.php';
//require_once $class_db;
//$config_db = require_once __DIR__ . '/../config/db_config.php';
//$db = PdoClass::getInstance($config_db);