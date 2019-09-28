<?php

namespace app\models;
use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "{{%cars_category}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $category_name
 * @property integer $is_recom
 * @property integer $order
 */
class CarsCategory extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cars_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_recom', 'order'], 'integer'],
            [['category_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'category_name' => 'Category Name',
            'is_recom' => 'Is Recom',
            'order' => 'Order',
        ];
    }

    public function getCarsCategoryByName($category_name , $where = array())
    {
        $info = $this -> find()
                    -> asArray()
                    -> where(['category_name' => $category_name])
                    -> andWhere($where)
//                    -> createCommand()
//                    -> getRawSql();
                    -> one();

        return $info;
    }

    public function addCarsCategory($data)
    {
        if(!is_array($data)){
            return false;
        }
        foreach($data as $key => $value)
        {
            $this -> $key = $value;
        }
        //有效性验证
        $this -> validate();
        if($this -> hasErrors())
        {
            //未通过验证
            foreach($this -> getErrors() as $ekey => $evalue)
            {
                echo $ekey . ":" . reset($evalue) . "<br/>";
            }
            die();
        }
        $resultSave = $this -> insert();
        return $resultSave;
    }
}
