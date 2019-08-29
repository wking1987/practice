<?php
if(!function_exists('__autoload')){
    function __autoload($className)
    {
        echo 'class name is :' . $className . "<br/>";
        $fileName = __DIR__ . '/' . substr($className , strlen($className)-1 , 1) . '.php';
        echo 'filename is :' . $fileName . "<br/>";
        include_once $fileName;
    }
}