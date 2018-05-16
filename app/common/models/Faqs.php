<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "faqs".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $status
 * @property integer $sort
 * @property integer $creation_time
 * @property integer $update_time
 *
 * @property FaqsInfo[] $faqsInfos
 */
class Faqs extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faqs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'status', 'sort', 'creation_time', 'update_time'], 'required'],
            [['status', 'sort', 'creation_time', 'update_time'], 'integer'],
            [['alias'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias (геренерируеться, если не заполнен)',
            'status' => 'Опубликовать',
            'sort' => 'SORT',
            'creation_time' => 'Date of creation',
            'update_time' => 'Date of update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqsInfos()
    {
        return $this->hasMany(FaqsInfo::className(), ['record_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\FaqsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\FaqsQuery(get_called_class());
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
    public function getInfo()
    {
        return $this->hasOne(FaqsInfo::className(), ['record_id'=>'id'])->onCondition([FaqsInfo::tableName().'.lang' => Lang::getCurrentId()]);
    }
    public function getUrl()
    {
        return Url::toRoute('/faq/'.$this->alias);

    }

}
