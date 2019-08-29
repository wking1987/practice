<?php
if(!extension_loaded('sockets')){
    die("sockets extension is not loaded");
};
$address = '127.0.0.1';
$port = '2345';
$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
$sock_data = socket_connect($sock, $address, $port);
var_dump($sock_data);
$arr = [
    'source' => 'php',
    'info' => 'pupupu',
];
$str = json_encode($arr);
socket_write($sock , $str , strlen($str));
socket_close($sock);