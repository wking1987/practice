<?php
/**
 * Created by PhpStorm.
 * User: wking
 * Date: 2019/8/8
 * Time: 15:28
 */

$username = 'zhangsan';
setcookie('username' , $username);
echo '设置名字为：' . $username;