<?php

namespace app\models;

use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "{{%styles}}".
 *
 * @property integer $styles_id
 * @property string $styles_name
 * @property string $styles_year
 * @property string $styles_price
 * @property string $styles_gas
 * @property string $discharge_standard
 * @property string $gear_type
 * @property integer $brand_id
 * @property integer $series_id
 */
class Styles extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%styles}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['styles_name', 'styles_year', 'styles_price', 'styles_gas', 'discharge_standard', 'gear_type'], 'required'],
            [['styles_price'], 'number'],
            [['brand_id', 'series_id'], 'integer'],
            [['styles_name'], 'string', 'max' => 48],
            [['styles_year'], 'string', 'max' => 20],
            [['styles_gas'], 'string', 'max' => 8],
            [['discharge_standard', 'gear_type'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'styles_id' => 'Styles ID',
            'styles_name' => 'Styles Name',
            'styles_year' => 'Styles Year',
            'styles_price' => 'Styles Price',
            'styles_gas' => 'Styles Gas',
            'discharge_standard' => 'Discharge Standard',
            'gear_type' => 'Gear Type',
            'brand_id' => 'Brand ID',
            'series_id' => 'Series ID',
        ];
    }
}
