<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property string $alias
 * @property string $price
 * @property string $type
 * @property integer $hide
 * @property integer $sort
 * @property integer $creation_time
 * @property integer $update_time
 *
 * @property ServicesInfo[] $servicesInfos
 */
class Services extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'price', 'type', 'hide', 'sort', 'creation_time', 'update_time'], 'required'],
            [['hide', 'sort', 'creation_time', 'update_time'], 'integer'],
            [['alias', 'price', 'type'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'price' => Yii::t('app', 'Price'),
            'type' => Yii::t('app', 'Type'),
            'hide' => Yii::t('app', 'Hide'),
            'sort' => Yii::t('app', 'Sort'),
            'creation_time' => Yii::t('app', 'Creation Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesInfos()
    {
        return $this->hasMany(ServicesInfo::className(), ['record_id' => 'id']);
    }
    public function getInfo()
    {
        return $this->hasOne(ServicesInfo::className(), ['record_id' => 'id'])
            ->andWhere([ServicesInfo::tableName().'.lang' => Lang::getCurrentId()]);
    }
    public static function find()
    {
        return new \common\models\Queries\ServicesQuery(get_called_class());
    }
}
