<?php
//定义一个抽象类
abstract class A
{
    public $param1 = 'abc';
    private $param2 = 'def';
    protected $param3 = 'hij';

    public function print_abc()
    {
        echo 'this is abstract clas A<br/>';
    }

    //抽象方法必须用abstract
    abstract function abs_1();
    abstract function abs_2();
}

//没有全部实现 A 的抽象方法，则该类也必须是抽象类
abstract class B extends A
{
    //B 已经实现了A的其中一个抽象方法，则普通类继承时，此方法可以不用再次实现
    public function abs_1()
    {
        echo 'function abs_1()<br/>';
    }

    //可以定义新的抽象类，而且普通类继承时，也要实现
    abstract function abs_3();
}

class C extends B
{
    //已经被B实现的抽象方法，也可以再次重新定义
    public function abs_1()
    {
        echo 'class C function abs_1()<br/>';
    }
    //未被实现的抽象方法，都需要被实现
    public function abs_2()
    {
        echo 'function abs_2()<br/>';
    }

    public function abs_3()
    {
        echo 'function abs_3()<br/>';
    }

    public function func_c()
    {
        echo 'class C -> func_c()<br/>';
    }
}

//继承了抽象类A，则必须实现全部抽象方法
class D extends A
{
    function abs_1()
    {
        echo 'class D -> function abs_1()<br/>';
    }

    function abs_2()
    {
        echo 'class D -> function abs_2()<br/>';
    }
    function abs_3()
    {
        echo 'class D -> function abs_3()<br/>';
    }
}


interface iA
{
    //接口定义的抽象方法，不需要abstract，并且不能是protect或private
    function fun_i1();
    function fun_i2();
}

interface iB
{
    function fun_i3();
    function fun_i4();
}

//可以继承一个父类，并可以实现多个接口
class E extends C implements iA,iB
{
    function fun_i1()
    {
        echo 'fun_i1()<br/>';
    }
    function fun_i2()
    {
        echo 'fun_i2()<br/>';
    }
    function fun_i3()
    {
        echo 'fun_i3()<br/>';
    }
    function fun_i4()
    {
        echo 'fun_i4()<br/>';
    }
}

$obj_e = new E();
$obj_e -> fun_i3();

/*$obj_c = new C();
$obj_c -> abs_1();
var_dump($obj_c);*/