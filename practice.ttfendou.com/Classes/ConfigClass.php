<?php
namespace Classes;
class ConfigClass
{
    private static $db_must_param = [
        'dbms'      => '数据库类型',
        'host'      => '数据库地址',
        'dbname'    => '数据库名称',
        'user'      => '数据库用户名',
    ];

    private static $db_must_read_param = [
        'host_read' => '查询数据库地址',
        'user_read' => '查询数据库用户名',
    ];

    private static $db_param = [
        'method'        => 1,
        'password'      => '',
        'password_read' => '',
        'table_prefix'  => '',
    ];

    public static function check_config_db($config)
    {
//方法为1或2,1：读写同库；2：读写分离
        $config['method'] = in_array($config['method'] , [1,2]) ? $config['method'] : 1;
        if($config['method'] == 2)
            $must_param = array_merge(self::$db_must_param , self::$db_must_read_param);
        foreach(self::$db_must_param as $key_must => $value_must)
        {
            if(empty($config[$key_must]))
            {
                exit($value_must . '不能为空！');
            }
        }

        foreach(self::$db_param as $key => $value)
        {
            if(empty($config[$key]))
            {
                $config[$key] = $value;
            }
        }

        $config['dsn'] = $config['dbms'] . ':host=' . $config['host'] . ';dbname=' . $config['dbname'];
        if($config['method'] == 1)
        {
            $config['dsn_read'] = $config['dsn'];
            $config['user_read'] = $config['user'];
            $config['password_read'] = $config['password'];
            $config['host_read'] = $config['host'];
        }else{
            $config['dsn_read'] = $config['dbms'] . ':host=' . $config['host_read'] . ';dbname=' . $config['dbname'];
        }
        return $config;
    }
}