<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "consist_products_assoc_10ml".
 *
 * @property integer $recipe_id
 * @property integer $product_id
 * @property integer $gouples
 */
class ConsistProductsAssoc10ml extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consist_products_assoc_10ml';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipe_id', 'product_id', 'gouples'], 'required'],
            [['recipe_id', 'product_id', 'gouples'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recipe_id' => 'Recipe ID',
            'product_id' => 'Product ID',
            'gouples' => 'Gouples',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\ConsistProductsAssoc10mlQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\ConsistProductsAssoc10mlQuery(get_called_class());
    }
    public function getProduct()
    {
        
        return $this->hasOne(CatalogProducts::className(),['id'=>'product_id']);
    }
}
