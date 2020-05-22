<?php
/**
 * @desc PhpStorm.
 * @author wk
 * @since 2018/3/11 23:35
 */
use controller\HttpController;
use controller\baseController;
use Model\newModel;
if(!defined('ACCESS'))
    exit('access abandon');
$action_arr = [
    'index',
    'get',
    'http',
    'extend',
];

if($a == '' || !in_array($a , $action_arr))
{
    exit('access abandon');
}
if($a == 'index')
{
    echo 'hhh';
}
elseif($a == 'http')
{
    
}elseif($a == 'extend')
{
    echo "<hr/>";
    var_dump(__FILE__);
    echo "<hr/>";
    echo "<hr/>";
    $new = new newModel($base);
    echo "<hr/>";
    var_dump($new);
    var_dump(123123123);
}

