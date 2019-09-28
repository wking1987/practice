<?php
    /**
     * Created by PhpStorm.
     * User: zhl
     * Date: 2017/2/12
     * Time: 17:58
     * 此文件主要连接数据库
     */
    return array(
        'URL_CASE_INSENSITIVE' => false,                           // url区分大小写
        //数据库配置信息
        'DB_TYPE'              => 'mysql', // 数据库类型
        'DB_HOST'              => 'localhost', // 服务器地址
        'DB_NAME'              => 'tp3', // 数据库名
        'DB_USER'              => 'root', // 用户名
        'DB_PWD'               => 'root', // 密码
        'DB_PORT'              => 3306, // 端口
        'DB_CHARSET'           => 'utf8', // 字符集
        'DATA_CACHE_TIME'      => 600,
        'DB_PREFIX'            => 'tp_', // 数据库表前缀
    );
