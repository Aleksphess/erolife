<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
/**
 * This is the model class for table "catalog_products".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $category_id
 * @property string $also_ids
 * @property integer $sort
 * @property integer $creation_time
 * @property integer $update_time
 *
 * @property CatalogProductsInfo[] $catalogProductsInfos
 */
class CatalogProducts extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'required'],
            [[ 'sort', 'creation_time', 'update_time'], 'integer'],
            [['alias', 'also_ids'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Алиас'),
        //    'category_id' => Yii::t('app', 'Относится к категории'),
            'also_ids' => Yii::t('app', 'Товары, которые рекомендуются покупать вместе с данным
             (ID товаров через запятую, пример: 545,567)'),
            'sort' => Yii::t('app', 'SORT'),
            'creation_time' => Yii::t('app', 'Date of creation'),
            'update_time' => Yii::t('app', 'Date of update'),
        ];
    }
    public function getImg()
    {
        $images = $this->searchImages();
        if (isset($images['b']) && is_array($images['b']) && count($images['b']))
        {
            foreach ($images['b'] as $pos => $path)
            {
                $images['b'][$pos] = Url::toRoute(['/product/image', 'alias' => $this->alias, 'number' => $pos]);
            }
        }
        return $images['b'];
    }

    public function getBImgS()
    {
        $images = $this->searchImages();
        return $images['b'];
    }

    public function getSImgS()
    {
        $images = $this->searchImages();
        return $images['s'];
    }

    public function getBImg()
    {
        $fname = '/images/' . $this->tableName() . '/' . floor($this->id / 1000) .'/' . $this->tableName() . '.'. $this->id . '.1.b.jpg';
        $fname_png = '/images/' . $this->tableName() . '/' . floor($this->id / 1000) .'/' . $this->tableName() . '.'. $this->id . '.1.b.png';

        if (is_file($_SERVER['DOCUMENT_ROOT']  . $fname))
        {
            
            return $fname;
        }
        elseif (is_file($_SERVER['DOCUMENT_ROOT']  . $fname_png))
        {
            return $fname_png;
        }
        else
        {
            return '/images/no-img.png';
        }
    }

    public function getSImg()
    {
        $fname = 'images/' . $this->tableName() . '/' . floor($this->id / 1000) .'/' . $this->tableName() . '.'. $this->id . '.1.s.jpg';
       // var_dump();die();
        if (is_file($_SERVER['DOCUMENT_ROOT']  . $fname))
        {
            return '/'.$fname;
        }
        else
        {
            return '/images/no-img.png';
        }
    }
    public function getImgs() {
        $i = 1;
        $res = [];
        $table_name = $this->tableName();
        while($i <= 8){
            //  var_dump(is_file($_SERVER['DOCUMENT_ROOT'].'/images/'. $table_name.'/' . floor($this->id / 1000) .'/' . $table_name.'.'. $this->id.".$i.b.jpg"));die();
            if(is_file($_SERVER['DOCUMENT_ROOT'].'/images/'. $table_name.'/' . floor($this->id / 1000) .'/' . $table_name.'.'. $this->id.".$i.b.jpg"))
            {
                $res[] =  [
                    'bimg' => '/images/'. $table_name.'/'. floor($this->id / 1000) .'/' . $table_name.'.'. $this->id.".$i.b.jpg",
                    'simg' => '/images/'. $table_name.'/'. floor($this->id / 1000) .'/' . $table_name.'.'.$this->id.".$i.s.jpg",
                ];
            }
            elseif (is_file($_SERVER['DOCUMENT_ROOT'].'/images/'. $table_name.'/' . floor($this->id / 1000) .'/' . $table_name.'.'. $this->id.".$i.b.png"))
            {
                $res[] =  [
                    'bimg' => '/images/'. $table_name.'/'. floor($this->id / 1000) .'/' . $table_name.'.'. $this->id.".$i.b.png",
                    'simg' => '/images/'. $table_name.'/'. floor($this->id / 1000) .'/' . $table_name.'.'.$this->id.".$i.s.jpg",
                ];
            }
            elseif($i == 1)
            {
                $res[] = '/images/no-img.png';
            }
            $i++;
        }
        return $res;
    }
    public function searchImages()
    {
        if (!$this->images)
        {
            $this->images = [
                's' => [],
                'b' => []
            ];

            //  Основные фото товаров
            $i = 1;
            while ($i < 5)
            {
                $fname = '/images/' . $this->tableName() . '/' . floor($this->id / 1000) .'/' . $this->tableName() . '.'. $this->id . '.'.$i.'.b.jpg';
                if (is_file(__DIR__ . '/../..' . $fname))
                {
                    $this->images['b'][] = $fname;
                    $this->images['s'][] = str_replace('.b.', '.s.', $fname);
                }
                $i++;
            }

            if (!count($this->images['s']))
            {
                $this->images['b'][] = '/images/no-img.png';
                $this->images['s'][] = '/images/no-img.png';
            }
        }

        return $this->images;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalogProductsInfos()
    {
        return $this->hasMany(CatalogProductsInfo::className(), ['record_id' => 'id']);
    }
    public function getInfo()
    {
        return $this->hasOne(CatalogProductsInfo::className(), ['record_id'=>'id'])->onCondition([CatalogProductsInfo::tableName().'.lang' => Lang::getCurrentId()]);
    }
    public function getParams()
    {
        return $this->hasMany(CatalogParams::className(), ['product_id' => 'id']);
    }
    public function getConsists()
    {
        return $this->hasMany(ConsistProductsAssoc::className(), ['product_id' => 'id']);
    }
    public function getTopics()
    {
        return $this->hasMany(TopicProductsAssoc::className(), ['product_id' => 'id']);
    }

    public function getParent()
    {
        return $this->hasOne(CatalogCategories::className(), ['id'=>'cat_id']);
    }

    public function getLabel()
    {
        return $this->hasOne(CatalogLabel::className(), ['id'=>'label_id']);
    }

    public function getUrl()
    {
        return Url::toRoute('/'.$this->parent->name_alt.'/'.$this->alias);
    }
    /**
     * @inheritdoc
     * @return \common\models\Queries\CatalogProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\Queries\CatalogProductsQuery(get_called_class());
    }

    public static function search()
    {
        $p = new \app\models\Queries\CatalogProducts(get_called_class());
        return $p->andWhere([self::tableName().'.hide' => 0]);
    }

    //	Метод добавляет в массив $data информацию о параметрах и доставке товаров
    public static function findParams($products, $data = [], $prefix = '')
    {
        $data[$prefix.'ids'] = [];
        $data[$prefix.'params'] = [];
        $data[$prefix.'delivery'] = [];

        if (is_array($products) && count($products))
        {
            //	Список ID товаров
            foreach ($products as $product)
            {
                $data[$prefix.'ids'][] = $product->id;
            }
            //	Значения параметров для отображаемых товаров
            $data[$prefix.'params'] = ExtraParamsCache::getProductParams($data[$prefix.'ids']);
            //	Сроки доставки для отображаемых товаров
            $data[$prefix.'delivery'] = ExtraParamsCache::getProductDelivery($data[$prefix.'ids']);
        }

        return $data;
    }
    public function getExtraparams()
    {
        return $this->hasMany(ExtraParamsCache::className(), ['product_id' => 'id'])
            ->select([
                'product_id',
                'param_id',
                'in_filter',
                'value_id',
                'param_name' => 'param_name_'.Lang::$current->id,
                'param_name_alt',
                'value_name' => 'value_name_'.Lang::$current->id
            ])
//                    ->orderBy('param_id DESC')
            ->asArray();
    }
    public function getFeedbacks()
    {
        return $this->hasMany(\common\models\ProductFeedbacks::className(), ['parent_id'=>'id'])->andWhere(['product_feedbacks.status'=>1]);
    }



}
