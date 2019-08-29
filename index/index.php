<?php
/**
 * @desc PhpStorm.
 * @author wk
 * @since 2018/3/11 23:35
 */
use controller\HttpController;
use controller\baseController;
if(!defined('ACCESS'))
    exit('access abandon');
$action_arr = [
    'index',
    'get',
    'http',
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
    
}

