<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property integer $id
 * @property string $name
 * @property string $href_url
 * @property integer $sort
 * @property integer $status
 * @property integer $creation_time
 * @property integer $update_time
 */
class Banners extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'href_url', 'sort', 'status', 'creation_time', 'update_time'], 'required'],
            [['sort', 'status', 'creation_time', 'update_time'], 'integer'],
            [['name', 'href_url'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'href_url' => 'Ссылка',
            'sort' => 'SORT',
            'status' => 'Отображать',
            'creation_time' => 'Date of creation',
            'update_time' => 'Date of update',
        ];
    }
    public function behaviors() {
        return [
            'thumb' => [
                'class' => \common\components\behavior\ImgBehavior::className()
            ],
            'timestamp' => [
                'class'              => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'creation_time',
                'updatedAtAttribute' => 'update_time',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\BannersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\BannersQuery(get_called_class());
    }
}
