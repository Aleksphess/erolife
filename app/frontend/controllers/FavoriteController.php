<?php
namespace frontend\controllers;


use Yii;
use common\components\BaseController;

use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;





class FavoriteController extends BaseController
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

                    'add' => ['post'],


                ]
            ]
        ];
    }


    public function actionAdd()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            throw new BadRequestHttpException();
        }
        $post = $request->post();

        $favorite = \common\models\Favorites::find()->where(['user_id'=>Yii::$app->user->identity->id])->andWhere(['product_id'=>$post['id']])->limit(1)->one();
        //var_dump($favorite);die();
        if(empty($favorite))
        {
            $new_favorite = new \common\models\Favorites();
            $new_favorite->user_id = Yii::$app->user->identity->id;
            $new_favorite->product_id = $post['id'];
            $new_favorite->save();
        }
        else
        {
            $favorite->delete();
        }

    }
}