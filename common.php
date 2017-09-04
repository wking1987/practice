<?php
if(!defined("ROOT_PATH"))
{
    define("ROOT_PATH" , "C:/wamp/www/");
}
if(!function_exists('__autoload'))
{
    function __autoload($class_name) {
        $path = str_replace('_', '/', $class_name);
        require_once ROOT_PATH . $path . '.php';
    }
}