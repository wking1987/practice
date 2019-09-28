<?php
namespace Classes;
use PDO;
use PDOException;
class PdoClass
{
    private $table_prefix;
    private $error_msg = '';
    private $dbh;
    private static $source_write;
    private static $source_read;
    private static $_instance = null;
    private static $error_code = [
        1   => 'Error:{#}表在数据库中不存在！',
        2   => 'Error:插入数据请使用一维数组！',
        3   => '',
        4   => '',
        5   => '',
        6   => '',
    ];

    private function __construct($config)
    {
        try{
            self::$source_write = new PDO($config['dsn'] , $config['user'] , $config['password'] , array(PDO::ATTR_PERSISTENT => true));
            self::$source_read = new PDO($config['dsn_read'] , $config['user_read'] , $config['password_read'] , array(PDO::ATTR_PERSISTENT => true));
        }catch (PDOException $e)
        {
            die("Error:" . $e -> getMessage() . "<br/>");
        }
        $this -> table_prefix = $config['table_prefix'];

    }

    static public function getInstance($config)
    {
        if (is_null ( self::$_instance ) || !isset ( self::$_instance )) {
            self::$_instance = new self ($config);
        }
        return self::$_instance;
    }

    /**
     * 设置错误信息
     * @param $code
     * @param $msg
     */
    private function set_error_msg($error_code , $msg = '')
    {
        $error_arr = self::$error_code;
        if($msg !== '')
        {
            $this -> error_msg = str_replace("{#}" , $msg , $error_arr[$error_code]);
        }else{
            $this -> error_msg = $error_arr[$error_code];
        }
    }

    public function get_error()
    {
        return $this -> error_msg;
    }

    /**
     * 获取数据库中的所有表
     * @return array
     */
    public function show_tables()
    {
        $sql = "SHOW TABLES";
        $stmt = self::$source_read -> prepare($sql);
        $stmt -> execute();
        $tables = $stmt -> fetchAll(PDO::FETCH_COLUMN);
        return $tables;
    }

    private function make_tablename($table)
    {
        $tablename = $this -> table_prefix . $table;
        return $tablename;
    }

    /**
     * 检查数据表是否存在
     * @param $table
     * @return bool
     */
    public function check_table_exists($table)
    {
        $table = $this -> make_tablename($table);
        $tables = $this -> show_tables();
        echo $table;
        print_r($tables);
        if(!in_array($table , $tables))
        {
            $this -> set_error_msg(1 , $table);
            return false;
        }
        return true;
    }

    /**
     * 查看表结构
     * @param $table
     */
    public function desc_table($table)
    {
        if(!($this -> check_table_exists($table))){
            $this -> set_error_msg(1 , $table);
            return false;
        }
        $table = $this -> make_tablename($table);
        $sql = "DESC " . $table;
        $stmt = self::$source_read -> prepare($sql);
        $stmt -> execute();
        $table_fileds = $stmt -> fetchAll(PDO::FETCH_COLUMN);
        return $table_fileds;
    }

    public function table($table)
    {
        
    }


    /**
     * 添加记录
     * @param $data_arr
     * @return bool
     */
    public function insert($table , $data_arr)
    {
        $table = $this -> make_tablename($table);
        if(!$this -> check_table_exists($table))
            return false;
        if(!is_array($data_arr))
        {
            $this ->error_msg = '请使用一维数组！';
            return false;
        }
    }

    private function make_insert($data_arr)
    {

    }

    /**
     * 删除记录
     * @param $where
     * @return bool
     */
    public function delet($where)
    {
        if(!is_string($where) || trim($where) == '')  return false;
    }

    /**
     * 删除记录
     * @param $data_arr
     * @return bool
     */
    public function update($data_arr)
    {
        if(!is_array($data_arr)) return false;
    }

    /**
     * 查询多个记录
     * @param $where
     * @return bool
     */
    public function select_list($where)
    {
        if(!is_string($where)) return false;
    }

    /**
     * 查询一条记录
     * @param $where
     * @return bool
     */
    public function select_one($where)
    {
        if(!is_string($where)) return false;
    }

    public function make_sql_insert($data_arr)
    {
        $column = '';
        $values = '';
        $tag = '';
        foreach($data_arr as $key => $value)
        {
            $column .= "," . $key;
            $values .= "," . $value;
            $tag = '';
        }
        $column = trim($column , ",");
        $values = trim($value , ",");
        $sql = '';
    }

    /**
     * 占位符无效调用
     */
    public function test_unuserfull_tag()
    {
        //模糊查询时，在预处理语句中使用%
        $stmt = $this -> dbh -> prepare('SELECT * FROM `pw_user` WHERE `username` LIKE "%?%"');

        //模糊查询时，在预处理语句中直接用占位符，不用引号"和百分号%
        $stmt = $this -> dbh -> prepare('SELECT * FROM `pw_user` WHERE username LIKE ?');


        if($stmt -> execute(['wk%']))
        {
            while($row = $stmt -> fetchAll(PDO::FETCH_ASSOC))
            {
                return $row;
            }
            return [];
        }else{
            return false;
        }
    }

    public function __destruct()
    {
        $this -> dbh = null;
    }
}