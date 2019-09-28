<?php
namespace app\page\controllers;

use app\controllers\BaseController;

class IndexController extends BaseController{
    public function actionIndex(){
        echo 'haha' . __FILE__;
    }
}