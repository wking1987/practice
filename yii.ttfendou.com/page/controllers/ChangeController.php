<?php

namespace app\page\controllers;
use app\models\Brand;
use app\models\Cars;
use app\models\CarsCategory;
use app\models\Series;
use app\models\Styles;

class ChangeController extends \app\controllers\BaseController
{
    public function actionIndex()
    {
        $carsObj = new Cars();
//        $list = $carsObj -> find() -> where('') -> asArray() -> all();
//        echo "<pre>";
//        print_r($list);
//        return $this->render('index');
    }

    //http://101.132.24.196/web/?r=change/brand
    public function actionBrand()
    {
        $brandObj = new Brand();
        $list = $brandObj -> find() -> asArray() -> all();
        echo "<pre>";
        print_r($list);
    }

    //http://101.132.24.196/web/?r=change/series
    public function actionSeries()
    {
        $seriesObj = new Series();
        $list = $seriesObj -> find() -> asArray() -> all();
        $this -> myPrint($list);
    }

    //http://101.132.24.196/web/?r=change/styles
    public function actionStyles()
    {
        $stylesObj = new Styles();
        $list = $stylesObj -> find()
                        -> asArray()
                        -> limit(20)
                        -> all();
        $this -> myPrint($list);
    }

    //http://101.132.24.196/web/?r=change/insertseries
    public function actionInsertseries()
    {
        $seriesObj = new Series();
        $carsCategoryObj = new CarsCategory();
        $listSeries = $seriesObj -> find()
                        -> asArray()
                        -> groupBy('series_groupname')
                        -> all();
        foreach($listSeries as $key => $value)
        {
            $exists = $carsCategoryObj -> getCarsCategoryByName($value['series_groupname'] , ['parent_id' => 0]);
            var_dump($exists);
            echo "<br/>";
            if(!$exists)
            {
                $dataNew = [
                    'parent_id' => 0,
                    'category_name' => $value['series_groupname'],
                    'is_recom' => 0,
                    'order' => 0,
                ];
                $result = $carsCategoryObj -> addCarsCategory($dataNew);
                var_dump($result);
            }
        }
    }

    //http://101.132.24.196/web/?r=change/insertseries2
    public function actionInsertseries2()
    {
        $seriesObj = new Series();
        $carsCategoryObj = new CarsCategory();
        $listSeries = $seriesObj -> find()
                            -> asArray()
                            -> all();
        foreach($listSeries as $key => $value)
        {
            $exists = $carsCategoryObj ->getCarsCategoryByName($value['series_name'] , [">" , "parent_id" , "0"]);
            if(!$exists)
            {
                $infoSeries = $carsCategoryObj -> find()
                                -> asArray()
                                -> where(['category_name' => $value['series_groupname']])
                                -> andWhere(['parent_id' => 0])
                                -> one();
                $dataNew = [
                    'parent_id' => $infoSeries['id'],
                    'category_name' => $value['series_name'],
                    'is_recom' => 0,
                    'order' => 0,
                ];
                $result = $carsCategoryObj -> addCarsCategory($dataNew);
                var_dump($result);

            }
        }
    }
}
