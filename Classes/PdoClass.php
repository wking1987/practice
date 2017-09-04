<?php

class PdoClass
{
    private $config_db = [
        'mysql' => [
            'dbms' => 'mysql',
            'host' => '127.0.0.1',
            'dbname' => 'phpwind9',
            'user' => 'root',
            'password' => '',
            'dsn' => 'mysql:host=localhost;dbname=phpwind9',
        ],

    ];
    private $dbh;

    public function __construct()
    {
        try{
            $this -> dbh = new PDO($this -> config_db['mysql']['dsn'] , $this -> config_db['mysql']['user'] , $this -> config_db['mysql']['password']);

        }catch (PDOException $e)
        {
            die("Error:" . $e -> getMessage() . "<br/>");
        }
    }

    /**
     * 添加记录
     * @param $data_arr
     * @return bool
     */
    public function insert($data_arr)
    {
        if(!is_array($data_arr)) return false;

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