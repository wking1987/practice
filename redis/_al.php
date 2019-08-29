<?php
if(!function_exists('__autoload')){
    function __autoload($className)
    {
        if(substr($className , 0 , 6) === 'handle')
        {
            echo WEB_PATH . "/handle/" . $className. "<br/>";
            $className = str_replace('\\' , '/' , $className);
            $fileName = WEB_PATH . '/' .$className . '.php';
            echo 'this is autoload ' . $fileName . "<br/>";
            require_once($fileName);
        }
    }
}