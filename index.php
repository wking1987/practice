<?php
define('ACCESS' , 'DEV');
$c = trim($_GET['c']);
$a = trim($_GET['a']);
$c = $c == '' ? 'index' : $c;
$a = $a == '' ? 'index' : $a;
require_once './common/common.php';
$file = $config['app_path'] . '/' . $c . '.php';
require_once $file;

?>
