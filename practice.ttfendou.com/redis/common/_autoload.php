<?php
if(!function_exists('__autoload')){
    function __autoload($className)
    {
        $className = array_pop(explode('\\' , $className));
         if(substr($className , 0 , 3) === 'Lib')
        {
            $fileName = WEB_PATH . '/lib/' . $className . '.php';

        }elseif(substr($className , 0 , 6) === 'Config')
        {
            $fileName = WEB_PATH . '/config/' . $className . '.php';

        }
//      echo $fileName . "<br/>";var_dump(file_exists($fileName));exit;
        require_once($fileName);
    }
}