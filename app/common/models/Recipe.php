<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recipe".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $category_id
 * @property integer $sort
 * @property integer $creation_time
 * @property integer $update_time
 *
 * @property RecipeInfo[] $recipeInfos
 */
class Recipe extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'category_id',  'creation_time'], 'required'],
            [['category_id', 'sort', 'creation_time', 'update_time'], 'integer'],
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
            'alias' => 'Алиас',
            'category_id' => 'Относится к категории',
            'sort' => 'SORT',
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
    public function getRecipeInfos()
    {
        return $this->hasMany(RecipeInfo::className(), ['record_id' => 'id']);
    }
    public function getInfo()
    {
        return $this->hasOne(RecipeInfo::className(), ['record_id' => 'id'])
            ->onCondition([RecipeInfo::tableName().'.lang' => Lang::getCurrentId()]);
    }

    public function getAssoc10ml()
    {
        return $this->hasMany(ConsistProductsAssoc10ml::className(), ['recipe_id' => 'id']);
    }
    public function getAssoc30ml()
    {
        return $this->hasMany(ConsistProductsAssoc30ml::className(), ['recipe_id' => 'id']);
    }
    public function getAssoc50ml()
    {
        return $this->hasMany(ConsistProductsAssoc50ml::className(), ['recipe_id' => 'id']);
    }
    public function  getParent()
    {
        return $this->hasOne(RecipeCategories::className(),['id'=>'category_id']);
    }
    public function getFeedbacks()
    {
        return $this->hasMany(Feedbacks::className(),['recipe_id'=>'id']);
    }
    public function  getUrl()
    {
        return \yii\helpers\Url::toRoute('/recipes/'.$this->alias);
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\RecipeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\RecipeQuery(get_called_class());
    }
}
