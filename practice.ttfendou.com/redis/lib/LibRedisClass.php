<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18
 * Time: 1:07
 */

namespace lib;


class LibRedisClass
{
    protected static $instance = null;
    protected function __construct(){

    }

    public static function getinstance(){
        if(is_null(self::$instance) || !isset(self::$instance)){
            self::$instance = new self;
        }
    }
}