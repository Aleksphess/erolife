<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vape_slovar_categories_info".
 *
 * @property integer $record_id
 * @property integer $lang
 * @property string $title
 *
 * @property VapeSlovarCategories $record
 */
class VapeSlovarCategoriesInfo extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vape_slovar_categories_info';
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
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => VapeSlovarCategories::className(), 'targetAttribute' => ['record_id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecord()
    {
        return $this->hasOne(VapeSlovarCategories::className(), ['id' => 'record_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\VapeSlovarCategoriesInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\VapeSlovarCategoriesInfoQuery(get_called_class());
    }
}
