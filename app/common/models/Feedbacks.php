<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "feedbacks".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $email
 * @property string $text
 * @property string $creation_time
 * @property string $update_time
 */
class Feedbacks extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedbacks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'email', 'text', 'creation_time'], 'required'],
            [['status', 'creation_time', 'update_time'], 'integer'],
            [['name', 'email', 'text'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя пользователя',
            'status' => 'Обработано',
            'email' => 'email пользователя',
            'text' => 'Комментарий',
            'creation_time' => 'Дата создания',
            'update_time' => 'Date of update',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\FeedbacksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\FeedbacksQuery(get_called_class());
    }
}
