<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $sort
 * @property integer $creation_time
 * @property integer $update_time
 *
 * @property PagesInfo[] $pagesInfos
 */
class Pages extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'sort', 'creation_time', 'update_time'], 'required'],
            [['sort', 'creation_time', 'update_time'], 'integer'],
            [['alias'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias (генерируеться, если не заполнен)'),
            'sort' => Yii::t('app', 'SORT'),
            'creation_time' => Yii::t('app', 'Date of creation'),
            'update_time' => Yii::t('app', 'Date of update'),
        ];
    }
    public function behaviors()
    {
        return [
            'timestamps' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'creation_time',
                'updatedAtAttribute' => 'update_time',
            ],
            'thumb' => [
                'class' => \common\components\behavior\ImgBehavior::className()
            ],
//            'translit' => [
//                'class' => \common\components\behavior\TranslitBehavior::className()
//            ],
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagesInfos()
    {
        return $this->hasMany(PagesInfo::className(), ['record_id' => 'id']);
    }
    public function getInfo()
    {
        return $this->hasOne(PagesInfo::className(), ['record_id'=>'id'])->onCondition([PagesInfo::tableName().'.lang' => Lang::getCurrentId()]);
    }
    public function getUrl()
    {
        return Url::toRoute('/'.$this->alias);
    }
    /**
     * @inheritdoc
     * @return \common\models\Queries\PagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\PagesQuery(get_called_class());
    }
}
