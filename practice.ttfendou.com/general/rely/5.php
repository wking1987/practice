<?php
/**
 * Created by wking
 * Date: 2019/12/5
 * Time: 10:59
 */
class SomeComponent
{
    protected $_di;
    public function __construct($di)
    {
        $this->_di = $di;
    }

    public function someDbTask()
    {
        $connection = $this->_di->get('db');
        return $connection;
    }

    public function someOtherDbTask()
    {
        $connection = $this->_di->getShared('db');

        $filter = $this->_di->get('filter');
        return ['db' => $connection , 'filter' => $filter];
    }
}

class Di
{
    protected $db_config = 'this is db_config';
    protected static $connection = [];

    /**
     *  返回新变量
     * @param $type
     * @return mixed
     */
    public function get($type)
    {
        $fun = 'set_' . $type;
        return $this->$fun();
    }

    /**
     *  返回静态变量
     * @param $type
     * @return mixed
     */
    public function getShared($type)
    {
        $fun = 'set_' . $type;
        if(!self::$connection[$type])
        {
            self::$connection[$type] = $this->$fun();
        }
        return self::$connection[$type];
    }

    public function set_db()
    {
        $config = $this->db_config;
        return 'db connection . ' . microtime(true) . ' AND db_config=' . $config;
    }

    public function set_filter()
    {
        return 'filter info ' . microtime(true);
    }

    public function set_session()
    {
        return 'session info ' . microtime(true);
    }
}

$db_config = 'this is db_config';
$di = new Di();
$some = new SomeComponent($di);
echo $some->someDbTask();
echo '<hr/>';
sleep(1);
echo $some->someDbTask();
echo "<hr/>";
sleep(1);
echo "<pre>";
print_r($some->someOtherDbTask());
sleep(1);
print_r($some->someOtherDbTask());
sleep(1);
print_r($some->someOtherDbTask());

