<?php
class wx
{
    public static $old;
    public function __construct()
    {
        self::$old = 22;
        echo 'fefe';
    }

    static function getName($name)
    {
        echo $name;
    }

    static function getOld()
    {
        echo self::$old;
    }
}


wx::getName('tom');
echo "<br/>";
wx::getOld();