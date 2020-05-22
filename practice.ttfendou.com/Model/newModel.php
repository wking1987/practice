<?php
/**
 * Created by wking
 * Date: 2020/2/21
 * Time: 22:26
 */
namespace Model;

use Library\Admin\Base;
class newModel
{
    public $base;
    public function __construct(base $base)
    {
        $this->base = $base;
        var_dump($base);
    }
}