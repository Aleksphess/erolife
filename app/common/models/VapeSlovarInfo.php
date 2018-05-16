<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vape_slovar_info".
 *
 * @property integer $record_id
 * @property integer $lang
 * @property string $title
 * @property string $description
 *
 * @property VapeSlovar $record
 */
class VapeSlovarInfo extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vape_slovar_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['record_id', 'lang', 'title', 'description'], 'required'],
            [['record_id', 'lang'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 250],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => VapeSlovar::className(), 'targetAttribute' => ['record_id' => 'id']],
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
            'title' => 'Заголовок',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(VapeSlovar::className(), ['id' => 'record_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\VapeSlovarInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\VapeSlovarInfoQuery(get_called_class());
    }
}
