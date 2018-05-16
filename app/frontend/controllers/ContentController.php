<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\components\SeoComponent;
use common\models\Pages;
use common\models\Lots;
use yii\helpers\Url;
use common\models\MainSlider;
use common\models\CatalogProducts;
use common\models\CatalogCategories;


class ContentController extends \common\components\BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'static', 'contacts','login','payment','reset','logup','iiko','forgot','reset-password','signin'],
                'rules' => [
                    [
                        'actions' => ['signup','logup','forgot','reset-password','signin'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],

                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['static', 'contacts','login','delivery','iiko'],
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'index' => ['get'],
                    'delivery' => ['get'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {

        SeoComponent::setByTemplate('main', [
            'name' => Yii::$app->view->params['main'],
        ]);

        $slides=MainSlider::find()->joinWith('info')->orderBy('sort DESC')->all();
        $brands = \common\models\Brands::find()->active()->limit(4)->all();
        $products_new = CatalogProducts::find()->where(['new'=>1])->limit(4)->all();
        $products_discount = CatalogProducts::find()->where(['discount'=>1])->limit(4)->all();
        $products_week = CatalogProducts::find()->where(['week'=>1])->limit(4)->all();
        $discount = \common\models\News::find()->active()->limit(1)->one();
        $pages = \common\models\Pages::find()->where(['useful'=>1])->all();
        return $this->render('index.twig', [
            'products_new'  =>  $products_new,
            'products_discount' => $products_discount,
            'products_week'  => $products_week,
            'slides'        =>  $slides,
            'brands'        => $brands,
            'discount'      => $discount,
            'pages'         => $pages
        ]);
    }




    public function actionStatic($alias)
    {
        $page=Pages::find()->byAlias($alias)->joinWith('info')->limit(1)->one();
        SeoComponent::setByTemplate('static', [
            'name' => $page->info->title,
        ]);
        return $this->render('static.twig', [
            'page' => $page,
        ]);
    }





    public function actionLogin()
    {
        SeoComponent::setByTemplate('default', [
            'name' => Yii::$app->view->params['login'],
        ]);
        if (!Yii::$app->user->isGuest)
        {
            return $this->redirect( Url::toRoute('/user/index'),301);
        }
        return $this->render('login.twig');
    }
    public function actionSignin()
    {
        SeoComponent::setByTemplate('default', [
            'name' => Yii::$app->view->params['login'],
        ]);
        if (!Yii::$app->user->isGuest)
        {
            return $this->redirect( Url::toRoute('/user/index'),301);
        }
        return $this->render('signin.twig');
    }

    public function actionForgot ()
    {
        SeoComponent::setByTemplate('default', [
            'name' => Yii::$app->view->params['login'],
        ]);
        if (!Yii::$app->user->isGuest)
        {
            return $this->redirect( Url::toRoute('/user/index'),301);
        }
        return $this->render('forgot.twig');
    }
    public function actionResetPassword ($id)
    {
        $current_user=\common\models\User::findOne(['password_reset_token'=>$id]);
        SeoComponent::setByTemplate('default', [
            'name' => Yii::$app->view->params['login'],
        ]);
        if (!Yii::$app->user->isGuest)
        {
            return $this->redirect( Url::toRoute('/user/index'),301);
        }
        return $this->render('remember.twig',['current_user'=>$current_user]);

    }



}