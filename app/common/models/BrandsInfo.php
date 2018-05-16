<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "brands_info".
 *
 * @property integer $record_id
 * @property integer $lang
 * @property string $title
 *
 * @property Brands $record
 */
class BrandsInfo extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brands_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['record_id', 'lang', 'title'], 'required'],
            [['record_id', 'lang'], 'integer'],
            [['title'], 'string', 'max' => 250],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['record_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'record_id' => 'Record ID',
            'lang' => 'Lang',
            'title' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(Brands::className(), ['id' => 'record_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\BrandsInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\BrandsInfoQuery(get_called_class());
    }
}
