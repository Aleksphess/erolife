<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recipe_categories".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $active
 * @property integer $category_id
 * @property integer $sort
 * @property integer $creation_time
 * @property integer $update_time
 *
 * @property RecipeCategoriesInfo[] $recipeCategoriesInfos
 */
class RecipeCategories extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipe_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'active', 'sort', 'creation_time', 'update_time'], 'required'],
            [['active', 'category_id', 'sort', 'creation_time', 'update_time'], 'integer'],
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
            'alias' => 'Alias (генерируеться, если не заполнен)',
            'active' => 'Активна',
            'category_id' => 'Category ID',
            'sort' => 'SORT',
            'creation_time' => 'Date of creation',
            'update_time' => 'Date of update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipeCategoriesInfos()
    {
        return $this->hasMany(RecipeCategoriesInfo::className(), ['record_id' => 'id']);
    }
    public function getInfo()
    {
        return $this->hasOne(RecipeCategoriesInfo::className(), ['record_id' => 'id'])
            ->onCondition([RecipeCategoriesInfo::tableName().'.lang' => Lang::getCurrentId()]);
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\RecipeCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\RecipeCategoriesQuery(get_called_class());
    }
}
