<?php

namespace app\models;
use app\models\BaseModel;
use Yii;

/**
 * This is the model class for table "{{%cars}}".
 *
 * @property integer $p_id
 * @property string $p_no
 * @property integer $aid
 * @property integer $cid
 * @property integer $rid
 * @property integer $uid
 * @property integer $eid
 * @property integer $sales_id
 * @property integer $p_brand
 * @property integer $p_subbrand
 * @property integer $p_subsubbrand
 * @property string $p_name
 * @property string $p_allname
 * @property string $p_keyword
 * @property string $p_price
 * @property string $p_cprice
 * @property string $p_purtax
 * @property integer $isconprice
 * @property integer $p_model
 * @property string $p_gas
 * @property string $p_kilometre
 * @property string $p_color
 * @property string $p_country
 * @property string $p_transmission
 * @property string $p_emission
 * @property string $p_fuel
 * @property integer $p_ontime
 * @property string $p_service_id
 * @property integer $p_onmonth
 * @property string $p_details
 * @property string $p_mainpic
 * @property string $p_pics
 * @property integer $p_hits
 * @property integer $issell
 * @property integer $p_addtime
 * @property integer $listtime
 * @property integer $isrecom
 * @property integer $isshow
 * @property integer $isren
 * @property string $p_username
 * @property string $p_tel
 * @property integer $p_transfer
 * @property string $p_insurance
 * @property string $p_inspection
 * @property string $p_caruse
 * @property string $p_maintenance
 * @property string $p_hlconfig
 * @property string $p_certificate
 * @property integer $is_open_img
 * @property integer $p_invoice
 * @property integer $isback
 * @property integer $isloan
 * @property integer $isrepair
 * @property string $mobilecode
 * @property integer $che300_id
 * @property integer $collectimg
 * @property integer $isdel
 * @property string $video_url
 * @property string $contract_pic
 * @property integer $is_show_mobile
 * @property integer $is_sold_out
 * @property string $car_tag
 * @property string $car_dealer
 * @property string $show_detail
 */
class Cars extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cars}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_no', 'rid', 'eid', 'p_subsubbrand', 'p_name', 'p_allname', 'p_keyword', 'p_price', 'p_cprice', 'p_purtax', 'p_model', 'p_gas', 'p_kilometre', 'p_color', 'p_country', 'p_transmission', 'p_emission', 'p_fuel', 'p_ontime', 'p_details', 'p_mainpic', 'p_pics', 'p_addtime', 'p_username', 'p_tel', 'p_transfer', 'p_insurance', 'p_inspection', 'p_caruse', 'p_maintenance', 'p_hlconfig', 'isback', 'isloan', 'isrepair', 'mobilecode', 'che300_id'], 'required'],
            [['aid', 'cid', 'rid', 'uid', 'eid', 'sales_id', 'p_brand', 'p_subbrand', 'p_subsubbrand', 'isconprice', 'p_model', 'p_ontime', 'p_onmonth', 'p_hits', 'issell', 'p_addtime', 'listtime', 'isrecom', 'isshow', 'isren', 'p_transfer', 'is_open_img', 'p_invoice', 'isback', 'isloan', 'isrepair', 'che300_id', 'collectimg', 'isdel', 'is_show_mobile', 'is_sold_out'], 'integer'],
            [['p_price', 'p_cprice', 'p_purtax', 'p_kilometre'], 'number'],
            [['p_details', 'p_pics'], 'string'],
            [['p_no'], 'string', 'max' => 12],
            [['p_name', 'p_country'], 'string', 'max' => 30],
            [['p_allname'], 'string', 'max' => 50],
            [['p_keyword'], 'string', 'max' => 200],
            [['p_gas', 'p_color', 'p_transmission'], 'string', 'max' => 10],
            [['p_emission', 'p_username', 'p_tel', 'p_insurance', 'p_inspection', 'p_caruse', 'p_maintenance'], 'string', 'max' => 32],
            [['p_fuel'], 'string', 'max' => 20],
            [['p_service_id', 'p_certificate', 'mobilecode', 'car_tag', 'car_dealer'], 'string', 'max' => 60],
            [['p_mainpic', 'p_hlconfig', 'contract_pic'], 'string', 'max' => 100],
            [['video_url'], 'string', 'max' => 120],
            [['show_detail'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p_id' => 'P ID',
            'p_no' => 'P No',
            'aid' => 'Aid',
            'cid' => 'Cid',
            'rid' => 'Rid',
            'uid' => 'Uid',
            'eid' => 'Eid',
            'sales_id' => 'Sales ID',
            'p_brand' => 'P Brand',
            'p_subbrand' => 'P Subbrand',
            'p_subsubbrand' => 'P Subsubbrand',
            'p_name' => 'P Name',
            'p_allname' => 'P Allname',
            'p_keyword' => 'P Keyword',
            'p_price' => 'P Price',
            'p_cprice' => 'P Cprice',
            'p_purtax' => 'P Purtax',
            'isconprice' => 'Isconprice',
            'p_model' => 'P Model',
            'p_gas' => 'P Gas',
            'p_kilometre' => 'P Kilometre',
            'p_color' => 'P Color',
            'p_country' => 'P Country',
            'p_transmission' => 'P Transmission',
            'p_emission' => 'P Emission',
            'p_fuel' => 'P Fuel',
            'p_ontime' => 'P Ontime',
            'p_service_id' => 'P Service ID',
            'p_onmonth' => 'P Onmonth',
            'p_details' => 'P Details',
            'p_mainpic' => 'P Mainpic',
            'p_pics' => 'P Pics',
            'p_hits' => 'P Hits',
            'issell' => 'Issell',
            'p_addtime' => 'P Addtime',
            'listtime' => 'Listtime',
            'isrecom' => 'Isrecom',
            'isshow' => 'Isshow',
            'isren' => 'Isren',
            'p_username' => 'P Username',
            'p_tel' => 'P Tel',
            'p_transfer' => 'P Transfer',
            'p_insurance' => 'P Insurance',
            'p_inspection' => 'P Inspection',
            'p_caruse' => 'P Caruse',
            'p_maintenance' => 'P Maintenance',
            'p_hlconfig' => 'P Hlconfig',
            'p_certificate' => 'P Certificate',
            'is_open_img' => 'Is Open Img',
            'p_invoice' => 'P Invoice',
            'isback' => 'Isback',
            'isloan' => 'Isloan',
            'isrepair' => 'Isrepair',
            'mobilecode' => 'Mobilecode',
            'che300_id' => 'Che300 ID',
            'collectimg' => 'Collectimg',
            'isdel' => 'Isdel',
            'video_url' => 'Video Url',
            'contract_pic' => 'Contract Pic',
            'is_show_mobile' => 'Is Show Mobile',
            'is_sold_out' => 'Is Sold Out',
            'car_tag' => 'Car Tag',
            'car_dealer' => 'Car Dealer',
            'show_detail' => 'Show Detail',
        ];
    }
}
