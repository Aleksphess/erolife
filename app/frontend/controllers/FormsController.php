<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Feedbacks;
use common\models\Callback;

class FormsController extends \common\components\BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'   => ['callback','feedback','subscription',

                        ],
                        'allow'     => true,
                        'roles'     => ['@', '?'],
                    ],
                ],
            ],
            'verbs' => [
                'class'     => VerbFilter::className(),
                'actions'   => [
                    'feedback'         => ['post'],
                    'callback'         => ['post'],
                    'subscription'     => ['post']
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['callback','feedback','subscription'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionCallback()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if(!$request->isAjax)
        {
            throw new BadRequestHttpException("Wrong request", 400);
        }
        $post                   = $request->post();
        $model                  = new \common\models\Callbacks();
        $model->name            = isset($post['name']) ? strip_tags($post['name']) : '';
        $model->phone           = isset($post['phone']) ? strip_tags($post['phone']) : '';
        $model->status          = 0;
        $model->creation_time   = date('U');
        if($model->save())
        {
            return ['answer'=>'success'];
        } else {
            foreach ($model->errors as $error)
            {
                return $error[0];
            }
        }
    }
    public function actionFeedback()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if(!$request->isAjax)
        {
            throw new BadRequestHttpException("Wrong request", 400);
        }
        $post                   = $request->post();

        $model                  = new \common\models\Feedbacks();
        $model->name            = isset($post['name']) ? strip_tags($post['name']) : '';
        $model->email            = isset($post['email']) ? strip_tags($post['email']) : '';
        $model->status          = 0;
        $model->text            = isset($post['text']) ? strip_tags($post['text']) : '';
        $model->creation_time   = date('U');
        if($model->save())
        {
            return ['answer'=>'success'];

        } else {
            foreach ($model->errors as $error)
            {
                return $error[0];
            }
        }
    }
    public function actionSubscription()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if(!$request->isAjax)
        {
            throw new BadRequestHttpException("Wrong request", 400);
        }
        $post                   = $request->post();

        $model                  = new \common\models\Subscriptions();

        $model->email            = isset($post['email']) ? strip_tags($post['email']) : '';

        $model->creation_time   = date('U');
        if($model->save())
        {
            return ['answer'=>'success'];

        } else {
            foreach ($model->errors as $error)
            {
                return $error[0];
            }
        }
    }


}