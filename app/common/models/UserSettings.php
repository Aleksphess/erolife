<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_settings".
 *
 * @property integer $id
 * @property string $menu
 */
class UserSettings extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu'], 'required'],
            [['menu'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu' => 'Меню для шаблона',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\UserSettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\UserSettingsQuery(get_called_class());
    }
}
