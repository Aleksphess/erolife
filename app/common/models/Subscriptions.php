<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscriptions".
 *
 * @property integer $id
 * @property string $email
 * @property string $creation_time
 * @property string $update_time
 */
class Subscriptions extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscriptions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'creation_time'], 'required'],
            [['creation_time', 'update_time'], 'integer'],
            [['email'], 'string', 'max' => 250],
            [['email'], 'unique', 'message' => 'Такой email уже есть в базе'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'email пользователя',
            'creation_time' => 'Дата создания',
            'update_time' => 'Date of update',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\SubscriptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\SubscriptionsQuery(get_called_class());
    }
}
