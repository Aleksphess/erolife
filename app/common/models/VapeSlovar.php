<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vape_slovar".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $creation_time
 * @property integer $update_time
 *
 * @property VapeSlovarInfo[] $vapeSlovarInfos
 */
class VapeSlovar extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vape_slovar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'creation_time', 'update_time'], 'required'],
            [['category_id', 'creation_time', 'update_time'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'creation_time' => 'Date of creation',
            'update_time' => 'Date of update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVapeSlovarInfos()
    {
        return $this->hasMany(VapeSlovarInfo::className(), ['record_id' => 'id']);
    }
    public function getInfo()
    {
        return $this->hasOne(VapeSlovarInfo::className(), ['record_id' => 'id'])
            ->onCondition([VapeSlovarInfo::tableName().'.lang' => Lang::getCurrentId()]);
    }
    public function getParent()
    {
        return $this->hasOne(VapeSlovarCategories::className(),['id'=>'category_id']);
    }
    /**
     * @inheritdoc
     * @return \common\models\Queries\VapeSlovarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\VapeSlovarQuery(get_called_class());
    }
}
