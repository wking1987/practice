<?php
namespace handle;
class handleGoods{
    static public $instance = null;
    protected function __construct()
    {
        echo 'this is __construct<br/>';
    }

    public static function getinstance()
    {
        var_dump(self::$instance);
        if(is_null(self::$instance) || !isset(self::$instance)){
            self::$instance = new self();
            echo 'this is new <br/>';
        }
        return self::$instance;
    }

    function index($pra){
        echo 'this is handle goods index';
        echo "<br/>filename is " . $pra;
    }
}