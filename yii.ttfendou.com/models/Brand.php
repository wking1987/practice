<?php

namespace app\models;
use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $brand_pic
 * @property string $brand_mark
 * @property string $brand_en
 * @property integer $isrecom
 * @property integer $brand_sort
 */
class Brand extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_name', 'brand_pic', 'brand_mark', 'brand_en', 'isrecom'], 'required'],
            [['isrecom', 'brand_sort'], 'integer'],
            [['brand_name'], 'string', 'max' => 32],
            [['brand_pic'], 'string', 'max' => 100],
            [['brand_mark'], 'string', 'max' => 8],
            [['brand_en'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'brand_pic' => 'Brand Pic',
            'brand_mark' => 'Brand Mark',
            'brand_en' => 'Brand En',
            'isrecom' => 'Isrecom',
            'brand_sort' => 'Brand Sort',
        ];
    }
}
