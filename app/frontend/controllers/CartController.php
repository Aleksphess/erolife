<?php
namespace frontend\controllers;

use Yii;
use common\components\BaseController;
use common\models\CatalogProducts;
use common\models\Orders;
use common\models\OrdersItems;
use common\models\OrdersTopics;
use common\components\SeoComponent;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;





class CartController extends BaseController
{

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function behaviors() {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'save-order' => ['post'],
                    'index' => ['get'],
                    'order' => ['get'],
                    'orders' => ['get'],
                    'repick-order' => ['post'],
                    'new-order' => ['post'],
                    'request'   => ['post'],
                    'change-count'  => ['post'],
                    'delete-from-backet'    => ['post'],
                    'change-count-ajax'  => ['post'],
                    'delete-from-backet-ajax'    => ['post'],
                    'clear'                 => ['post'],
                    'request-product'      => ['post'],
                    'change-topic'      => ['post'],
                    'change-topic-backet'      => ['post'],
                    'promo'                 => ['post'],
                    'change-address'        => ['post'],
                    'stop'                  => ['post']
                ]
            ]
        ];
    }
    public function actionRequest()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        if (isset($post)) {

            if ( $post['id'] > 0)
            {
                if (!isset($_SESSION['cart'][$post['id']]))
                {
                    $_SESSION['cart'][$post['id']] = 1;
                }
                else{
                    $_SESSION['cart'][$post['id']] += 1;
                }

                $cart_count = count($_SESSION['cart']);
                return ['cart_count' => $cart_count];
            }
        }
    }

    public function actionRequestProduct()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = Yii::$app->request->post();

        if (isset($post)) {

            if ( $post['id'] > 0)
            {
                if (!isset($_SESSION['cart'][$post['id']]))
                {
                    $_SESSION['cart'][$post['id']] = intval($post['count']);
                }
                else{
                    $_SESSION['cart'][$post['id']] += intval($post['count']);
                }

                $cart_count = count($_SESSION['cart']);
                return ['cart_count' => $cart_count];
            }
        }

    }




    public function actionChangeCount()
    {

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        if (isset($post)) {

            //  Если товар есть в наличии, выполняю добавление в корзину
            if ( $post['id'] > 0)
            {
                $_SESSION['cart'][$post['id']] = intval($post['count']);


            }

            if($session->isActive && $session->has('cart') && !empty($session['cart']))
            {
                $products = [];
                $fullprice = 0;
                foreach ($_SESSION['cart'] as $item_id=>$count)
                {
                    $product = CatalogProducts::find()->byId($item_id)->limit(1)->one();
                    $products[] = [
                        'product' => $product,
                        'count'   => $count
                    ];
                    $fullprice += intval($product->price) * intval($count);

                }

                return $this->renderAjax('backet-ajax.twig',[
                    'products' => $products,
                    'count' => count($_SESSION['cart']),
                    'fullprice' => $fullprice,

                ]);

            } else
            {
                return $this->render('empty_cart.twig', [

                ]);
            }

        }
    }

    public function actionDeleteFromBacket()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $post = Yii::$app->request->post();


    }



    public function actionBacket()
    {
        $session = Yii::$app->session;

        Yii::$app->view->registerMetaTag([
            'name' => 'robots',
            'content' => 'NOINDEX,NOFOLLOW'
        ]);

        SeoComponent::setByTemplate('default', [
            'name' => $this->view->params['backet'],
        ]);

        if($session->isActive && $session->has('cart') && !empty($session['cart']))
        {
            $products = [];
            $fullprice = 0;
            foreach ($_SESSION['cart'] as $item_id=>$count)
            {
                $product = CatalogProducts::find()->byId($item_id)->limit(1)->one();
                $products[] = [
                    'product' => $product,
                    'count'   => $count
                ];
                $fullprice += intval($product->price) * intval($count);

            }

            return $this->render('backet.twig',[
                'products' => $products,
                'count' => count($_SESSION['cart']),
                'fullprice' => $fullprice,

            ]);

        } else
        {
            return $this->render('empty_cart.twig', [

            ]);
        }

    }

    public function actionOrder()
    {
        $session = Yii::$app->session;

        Yii::$app->view->registerMetaTag([
            'name' => 'robots',
            'content' => 'NOINDEX,NOFOLLOW'
        ]);

        SeoComponent::setByTemplate('default', [
            'name' => $this->view->params['backet'],
        ]);

        if($session->isActive && $session->has('cart') && !empty($session['cart']))
        {

            $fullprice = 0;
            foreach ($_SESSION['cart'] as $item_id=>$count)
            {
                $product = CatalogProducts::find()->byId($item_id)->limit(1)->one();
                $fullprice += intval($product->price) * intval($count);
            }

            return $this->render('order.twig',[
                'count' => count($_SESSION['cart']),
                'fullprice' => $fullprice,

            ]);

        } else
        {
            return $this->render('empty_cart.twig', [

            ]);
        }
    }

    public function actionSaveOrder()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            throw new BadRequestHttpException();
        }
        $post = $request->post();
        $session = Yii::$app->session;
        if ($session->isActive && $session->has('cart') && !empty($session['cart'])) {

            $order = new \common\models\Orders();
            $order_items = new OrdersItems();
            $backet = Orders::getCartInfo();

            $order->name = (trim(strip_tags($post['first-name'])));
            $order->phone = (trim(strip_tags($post['phone'])));
            $order->email = (trim(strip_tags($post['email'])));
            $order->last_name = (trim(strip_tags($post['last-name'])));

            $order->address = (isset($post['address']))? (trim(strip_tags($post['address']))) : ' ';
            $order->street = (isset($post['street']))? (trim(strip_tags($post['street']))) : ' ';
            $order->build = (isset($post['build']))? (trim(strip_tags($post['build']))) : ' ';
            $order->user_id = (!Yii::$app->user->isGuest) ? Yii::$app->user->identity->id : -1;

            $order->comment = (isset($post['comment']))? (trim(strip_tags($post['comment']))) : ' ';
            $order->pay_id = $post['payment'];
            $order->delivery_id = $post['delivery'];
            $order->status_id = 3;

            $order->creation_time = date('U');


            $fullprice = 0;
            $message = '';
            $message .= 'Имя получателя:'.$order->name.'<br>';
            $message .= 'Фамилия:'.$order->last_name .'<br>';
            $message .= 'Телефон:'.$order->phone.'<br>';
            $message .= 'Почта:'. $order->email.'<br>';
            $message .= 'Город доставки:'.$order->address.'<br>';
            $message .= 'Улица:'.$order->street.'<br>';
            $message .= 'Дом:'.$order->build.'<br>';
            $message .= 'Комментарий:'.$order->comment.'<br>';
            $message .= 'Способ доставки:'.\common\models\OrdersParams::find()->andWhere(['id'=>$order->pay_id])->limit(1)->one()->name.'<br>';
            $message .= 'Способ оплаты:'.\common\models\OrdersParams::find()->andWhere(['id'=>$order->delivery_id])->limit(1)->one()->name.'<br>';
            $message .= '==========================Товары=======================<br>';
            foreach ($_SESSION['cart'] as $item_id=>$count)
            {

                $product = CatalogProducts::find()->byId($item_id)->limit(1)->one();
                $products[] = [
                    'product' => $product,
                    'count'   => $count
                ];
                $fullprice += intval($product->price) * intval($count);
                $message .= 'Товар:'.$product->info->name.'<br>';
                $message .= 'Количество:'.$count.'<br>';
                $message .= 'Цена:'.$product->price.'<br>';
            }
                $message .= 'Общая цена:'.$fullprice.'<br>';



            $order->total = $fullprice;

            $transaction = Yii::$app->getDb()->beginTransaction();


            if ($order->save()) {

                $save_items_status = $order_items->saveOrderItems($backet['products'], $order->id);
                if($save_items_status)
                {
                    $transaction->commit();
                    $_SESSION['cart'] = [];
                    $headers  = "Content-type: text/html; charset=UTF-8 \r\n";
                    $headers .= "From:erolife.kz \r\n";
                    mail('aleksphesspro@gmail.comz' ,'Ваш заказ',$message, $headers);
                    return ['answer' => 'success', 'order_id' => $order->id,'url' => Url::toRoute('/success')];

                }





                 //   return ['answer' => 'success', 'order_id' => $order->id,'url'=>$url_pay];

            }
        }


    }


    public function actionSuccess()
    {
        return $this->render('success.twig', [

        ]);
    }

}