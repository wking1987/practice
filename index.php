<?php
define('ACCESS' , 'DEV');
$c = isset($_GET['c']) ? trim($_GET['c']) : '';
$a = isset($_GET['a']) ? trim($_GET['a']) : '';
$c = $c == '' ? 'index' : $c;
$a = $a == '' ? 'index' : $a;
require_once './common/common.php';
$file = $config['app_path'] . '/' . $c . '.php';
require_once $file;

?>
