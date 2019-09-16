<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/9/11
 * Time: 11:06
 */

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
$time_start = microtime_float();
// Sleep for a while
usleep(1000);
$time_end = microtime_float();
$time = $time_end - $time_start;
echo "Did nothing in $time seconds\n";
?>