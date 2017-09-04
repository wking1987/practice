<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/4
 * Time: 12:18
 */

class LibUtilClass
{
    public static function writeLog($content , $filename)
    {
        $filename = trim($filename , '.log');
        if($filename == '')return false;
        $dirLog = WEB_PATH . '/log/';
        $filename = $dirLog . $filename . '.log';
        $content = '[' . date("Y-m-d H:i:s" , time()) . ']' . json_encode($content) . "\n";
        if(!file_exists($filename))
        {
            $resultTouch = touch($filename);
            if(!$resultTouch)
            {
                return false;
            }
        }
        $handle = fopen($filename , 'a');
        $result = false;
        if(fwrite($handle , $content)){
            $result = true;
        }
        fclose($handle);
        return $result;
    }
}