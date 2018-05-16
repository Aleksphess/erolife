<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_feedbacks".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $text
 * @property integer $parent_id
 * @property string $sort
 * @property string $creation_time
 * @property string $update_time
 */
class ProductFeedbacks extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_feedbacks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'text', 'parent_id',  'creation_time'], 'required'],
            [['status', 'parent_id', 'sort', 'creation_time', 'update_time'], 'integer'],
            [['text'], 'string'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя клиента',
            'status' => 'Опубликовать',
            'text' => 'Текст отзыва',
            'parent_id' => 'ОТтносится к новости',
            'sort' => 'SORT',
            'creation_time' => 'Date of creation',
            'update_time' => 'Date of update',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\ProductFeedbacksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\ProductFeedbacksQuery(get_called_class());
    }
}
