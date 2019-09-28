<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%model}}".
 *
 * @property integer $s_id
 * @property string $s_name
 * @property string $s_pic
 * @property integer $orderid
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_name', 's_pic'], 'required'],
            [['orderid'], 'integer'],
            [['s_name'], 'string', 'max' => 10],
            [['s_pic'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            's_id' => 'S ID',
            's_name' => 'S Name',
            's_pic' => 'S Pic',
            'orderid' => 'Orderid',
        ];
    }
}
