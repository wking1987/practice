<?php
if(!defined("APP_ROOT"))
{
    define("APP_ROOT" , '/data/yii');
}
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
$file_autoload = APP_ROOT . '/vendor/autoload.php';
$file_yii = APP_ROOT . '/vendor/yiisoft/yii2/Yii.php';
$file_config = APP_ROOT . '/config/web.php';


require($file_autoload);
require($file_yii);
$config = require($file_config);

//require(__DIR__ . '/../vendor/autoload.php');
//require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
//$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
