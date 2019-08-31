<?php
/**
 *  DNS查询
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/30
 * Time: 16:01
 */

//执行DNS查询
swoole_async_dns_lookup("www.baidu.com", function($host, $ip){
    echo "{$host} : {$ip}\n";
});

/**
 *  执行报错
 *  Call to undefined function swoole_async_dns_lookup()
 */