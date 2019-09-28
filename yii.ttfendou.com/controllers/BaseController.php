<?php
namespace app\controllers;

class BaseController extends \yii\web\Controller
{
    public function myPrint($content)
    {
        echo "<pre>";
        print_r($content);
        echo "</pre>";
    }
}