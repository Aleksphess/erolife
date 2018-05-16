<?php

namespace frontend\controllers;

use Symfony\Component\Console\Question\Question;
use Twig\Node\Expression\Binary\AddBinary;
use Yii;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\SeoComponent;
use common\models\Lots;
use common\models\User;
use yii\imagine\Image;
use common\models\Payment;
use common\models\AddressDelivery;


class UserController extends \common\components\BaseController
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class'     => AccessControl::className(),
//                'only'      => ['index'],
                'rules'     => [
                    [
                        'actions'   => ['index', 'settings', 'change-settings','payment-static','lot',
                            'change-password','add-address','delete-address','change-address','orders','question',
                            'save-question','delete-favorite'
                        ],
                        'allow'     => true,
                        'roles'     => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'save-question'         => ['post'],
                    'index'                 => ['get'],
                    'settings'              => ['get'],
                    'change-settings'       => ['post'],
                    'change-password'       => ['post'],
                    'add-address'           => ['post'],
                    'delete-address'        => ['post'],
                    'change-address'        => ['post'],
                    'orders'                => ['get'],
                    'question'                => ['get'],
                    'delete-favorite'       => ['post']

                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    
    public function actionIndex()
    {
        Yii::$app->view->registerMetaTag([
            'name' => 'robots',
            'content' => 'NOINDEX,NOFOLLOW'
        ]);

        SeoComponent::setByTemplate('user', [
            'name' => Yii::$app->params->view['profile'],
        ]);
                return $this->render('old_index.twig', [
										   ]);
    }
    

    
    public function actionChangeSettings()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request=Yii::$app->request;
        if(!$request->isAjax)
        {
            throw new BadRequestHttpException();
        }
        $post = $request->post();

            $current_user = User::findIdentity(Yii::$app->user->identity->id);
            $current_user->username=trim(strip_tags($post['username']));
            $current_user->email=trim(strip_tags($post['email']));
            $current_user->phone=trim(strip_tags($post['phone']));



            if( $current_user->update())
            {
                         return ['answer'=>true,'text'=>'Сохранения изменены'];
            }
            return ['status' => false];


    }
    public function actionChangePassword()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request=Yii::$app->request;
        if(!$request->isAjax)
        {
            throw new BadRequestHttpException();
        }
        $post = $request->post();

        $current_user = User::findIdentity(Yii::$app->user->identity->id);

        if(!Yii::$app->getSecurity()->validatePassword($post['old_password'], $current_user->password_hash))
        {
            return ['status'=> false,'text' => $this->view->params['inccorect_password']];
        }

        if($post['new_password']==$post['old_password'])
        {
            return ['status'=> false,'text' => $this->view->params['old_corect_new']];
        }
        if($post['new_password']!=$post['repeat_password'])
        {
            return ['status'=> false,'text' => $this->view->params['password_rrr']];
        }
        if(empty($post['new_password']))
        {
            return ['status'=> false,'text' => $this->view->params['empty_password']];
        }

        $current_user->setPassword($post['new_password']);

        if( $current_user->update())
        {
            return ['status'=> true,'text' =>$this->view->params['successsss']];
        }
        return ['status' => false];


    }
    public function actionDeleteFavorite()
    {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $request = Yii::$app->request;
            if (!$request->isAjax) {
                throw new BadRequestHttpException();
            }
            $post = $request->post();

            $favorite = \common\models\Favorites::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['product_id'=>$post['id']])->limit(1)->one();
            $favorite->delete();

            return $this->renderAjax('favorite.twig');


    }




}