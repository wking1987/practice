<?php
$get = ini_get('disable_functions');
var_dump($get);
echo "<hr/>";
function a($txt)
{
    return b("hello");
}
function b($txt)
{
    return c("word");
}
function c($txt)
{
    $braktrace = debug_backtrace();
    return $braktrace;
}
echo "<pre>";
$braktrace = a('good');
print_r($braktrace);
echo "\n";
echo dirname($braktrace[0]['file']);