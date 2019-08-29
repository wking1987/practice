<?php
return [
    'method'    => 1,  //1:单库；2:读写分离
    'dbms'      => 'mysql',
    'table_prefix'  => 'practice_',
    'host'      => '127.0.0.1',
    'dbname'    => 'practice',
    'user'      => 'root',
    'password'  => 'root',
    'host_read' => '127.0.0.1',
    'user_read' => 'root',
    'password_read' => 'root',
];