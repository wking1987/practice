<?php
if(!function_exists('__autoload'))
{
    function __autoload($classname)
    {
        $filename = ROOT_PATH . "/" . $classname . ".php";
        $filename = str_replace("\\" , "/" , $filename);
//        echo $classname . '[' . $filename . ']-' . var_dump(file_exists($filename)) . '<br/>';
        require_once $filename;
    }
}