<?php
/**
 * Created by wking
 * Date: 2020/2/21
 * Time: 23:06
 */
declare (strict_types = 1);
namespace Library\Admin;

class Base
{
    protected $name = '\Library\Admin';
    public function __construct()
    {
        echo 111;
    }
}