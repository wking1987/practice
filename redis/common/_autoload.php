<?php
if(!function_exists('__autoload')){
    function __autoload($className)
    {
         if(substr($className , 0 , 3) === 'Lib')
        {
            $fileName = WEB_PATH . '/lib/' . $className . '.php';
            include_once $fileName;
        }
    }
}