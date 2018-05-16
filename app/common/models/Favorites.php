<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property integer $user_id
 * @property integer $product_id
 */
class Favorites extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\Queries\FavoritesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\FavoritesQuery(get_called_class());
    }

    public function getProduct()
    {
        return $this->hasOne(\common\models\CatalogProducts::className(), ['id' => 'product_id']);
    }
}
