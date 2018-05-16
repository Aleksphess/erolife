<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "brands".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $sort
 * @property integer $active
 * @property integer $creation_time
 * @property integer $update_time
 *
 * @property BrandsInfo[] $brandsInfos
 */
class Brands extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'sort', 'active', 'creation_time', 'update_time'], 'required'],
            [['sort', 'active', 'creation_time', 'update_time'], 'integer'],
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
            'alias' => 'alias',
            'sort' => 'SORT',
            'active' => 'Отображать',
            'creation_time' => 'Date of creation',
            'update_time' => 'Date of update',
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
    public function getBrandsInfos()
    {
        return $this->hasMany(BrandsInfo::className(), ['record_id' => 'id']);
    }
    public function getInfo()
    {
        return $this->hasOne(BrandsInfo::className(), ['record_id' => 'id'])
            ->onCondition([BrandsInfo::tableName().'.lang' => Lang::getCurrentId()]);
    }
    public function getUrl()
    {
        return Url::toRoute('/brands/'.$this->alias);
    }
    public function getLogomain()
    {
       //var_dump($_SERVER['DOCUMENT_ROOT'].'/userfiles/png/'.$this->logo);die();
        if(is_file($_SERVER['DOCUMENT_ROOT'].'/userfiles/png/'.$this->logo))
        {
            return '/userfiles/png/'.$this->logo;
        }
        return '/userfiles/no-img.png';
    }
    /**
     * @inheritdoc
     * @return \common\models\Queries\BrandsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\BrandsQuery(get_called_class());
    }
}
