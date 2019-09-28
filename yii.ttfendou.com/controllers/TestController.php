<?php

namespace app\controllers;
use Yii;
class TestController extends \app\controllers\BaseController
{
    public function actionIndex(){
        echo "<pre>";
        $params = Yii::$app -> components;
        print_r($params);

        echo __DIR__ . "<br/>";
        echo dirname(__DIR__);
    }

    public function actionRedis(){
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        echo "Connection to server sucessfully";
        //查看服务是否运行
        echo "Server is running: " . $redis->ping();
    }
}
