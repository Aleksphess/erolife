<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "callbacks".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $phone
 * @property string $creation_time
 * @property string $update_time
 */
class Callbacks extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'callbacks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'phone', 'creation_time'], 'required'],
            [['status', 'creation_time', 'update_time'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 250],
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
            'phone' => 'Телефон пользователя',
            'creation_time' => 'Дата создания',
            'update_time' => 'Date of update',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\CallbacksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\CallbacksQuery(get_called_class());
    }
}
