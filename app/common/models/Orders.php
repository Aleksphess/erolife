<?php

namespace common\models;


use app\models\OrdersItems;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class Orders extends ActiveRecord
{
    private static $params = NULL;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name',  'phone'], 'required'],
            [['name', 'phone'], 'string', 'min' => 2, 'max' => 100],
            [['comment'], 'string', 'min' => 0, 'max' => 1000],
            [['email'], 'email'],
            [['status_id', 'pay_id', 'delivery_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Имя'),
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'comment' => Yii::t('app', 'Комментарий'),
            'address' => Yii::t('app', 'Адрес доставки'),
            'delivery_id' => Yii::t('app', 'Способ доставки'),
            'pay_id' => Yii::t('app', 'Способ оплаты'),
            'city_id' => Yii::t('app', 'Город доставки'),
            'filial_id' => Yii::t('app', 'Отделение Новой Почты'),
        ];
    }

    public static function getCartInfo()
    {
        $cart = [
            'products' => [],
            'count' => 0,
            'cost' => 0,
           'url' => Url::toRoute('/cart/index')
        ];
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']))
        {
            $cart['products'] = $_SESSION['cart'];
        }

        if (count($cart['products']))
        {
         //   $products = CatalogProducts::find()->byId(array_keys($cart['products']))->active()->all();
            foreach ($cart['products'] as $item_id=>$item_count)
            {
                $product = CatalogProducts::find()->byId($item_id)->active()->one();
                $cart['count'] += $cart['products'][$product->id];
                $cart['cost'] += $cart['products'][$product->id] * $product->price;
                $cart['products'][$product->id] = [
                    'id' => $product->id,
                  //  'articul' => $product->articul,
                    'name' => $product->info->name,
                    'url' => $product->url,
                    'price' => $product->price,
                    'count' => $cart['products'][$product->id],
                    'cost' => $cart['products'][$product->id] * $product->price,
                    'image' => $product->simg
                ];
            }
        }

        return $cart;
    }

    public static function getOrdersParams()
    {
        if (self::$params === NULL)
        {
            self::$params = [];

            $conn = Yii::$app->getDb();
            $q = "SELECT `id`, `name`, `type`, `add_cost`, `system_key` "
                ."FROM `orders_params` "
                ."ORDER BY `sort` ASC";
            $res = $conn->createCommand($q)->queryAll();
            if ($res)
            {
                foreach ($res as $row)
                {
                    self::$params[$row['type']][$row['id']] = $row;
                }
            }
        }

        return self::$params;
    }

    public function getProducts()
    {
        $products = [];
        $conn = Yii::$app->getDb();
        $q = "SELECT `product_id`, `count`, `price`, `installation`, `subtotal` "
            ."FROM `orders_items` "
            ."WHERE `order_id`=".(int)$this->id;
        $res = $conn->createCommand($q)->queryAll();
        if (is_array($res) && count($res))
        {
            foreach ($res as $row)
            {
                $products[$row['product_id']] = $row;
            }
        }

        $info = CatalogProducts::find()->base()->byId(array_keys($products))->all();
        if ($info)
        {
            foreach ($info as $one)
            {
                $products[$one->id]['name'] = $one->info->name;
                $products[$one->id]['image'] = $one->imgs[0];
                $products[$one->id]['articul'] = $one->articul;
                $products[$one->id]['url'] = $one->url;
            }
        }

        return $products;
    }
    public function getItemss()
    {
        return $this->hasMany(\common\models\OrdersItems::className(),['order_id'=>'id']);
    }
}