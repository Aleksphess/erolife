<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vape_slovar_categories".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $parent_id
 * @property integer $category_id
 * @property integer $creation_time
 * @property integer $update_time
 *
 * @property VapeSlovarCategoriesInfo[] $vapeSlovarCategoriesInfos
 */
class VapeSlovarCategories extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vape_slovar_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'creation_time', 'update_time'], 'required'],
            [['parent_id', 'category_id', 'creation_time', 'update_time'], 'integer'],
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
            'parent_id' => 'Parent ID',
            'category_id' => 'Category ID',
            'creation_time' => 'Date of creation',
            'update_time' => 'Date of update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVapeSlovarCategoriesInfos()
    {
        return $this->hasMany(VapeSlovarCategoriesInfo::className(), ['record_id' => 'id']);
    }
    public function getInfo()
    {
        return $this->hasOne(VapeSlovarCategoriesInfo::className(), ['record_id' => 'id'])
            ->onCondition([VapeSlovarCategoriesInfo::tableName().'.lang' => Lang::getCurrentId()]);
    }
    public function getChilds()
    {
        return $this->hasMany(VapeSlovar::className(),['category_id'=>'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\VapeSlovarCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\VapeSlovarCategoriesQuery(get_called_class());
    }
}
