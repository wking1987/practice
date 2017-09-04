<?php
function dump($content , $type = 'print' , $cols=200 , $rows=200)
{
    echo "<textarea rows='" . $rows . "' cols='" . $cols . "'>";
    if($type == 'dump')
    {
        var_dump($content);
    }elseif($type == 'print')
    {
        print_r($content);
    }
    echo "</textarea>";
}