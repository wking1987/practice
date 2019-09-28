<?php

namespace app\models;
use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "{{%series}}".
 *
 * @property integer $series_id
 * @property string $series_name
 * @property string $series_groupname
 * @property integer $brand_id
 */
class Series extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%series}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['series_name', 'series_groupname'], 'required'],
            [['brand_id'], 'integer'],
            [['series_name', 'series_groupname'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'series_id' => 'Series ID',
            'series_name' => 'Series Name',
            'series_groupname' => 'Series Groupname',
            'brand_id' => 'Brand ID',
        ];
    }
}
