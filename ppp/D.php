<?php
//use \a\classNameA;
class classNameD{
    function index(){echo "it's D";}

    function get_a()
    {
        $obj_a = new \a\classNameA();
        $obj_a -> index();
    }
}