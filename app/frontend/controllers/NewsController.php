<?php

namespace frontend\controllers;

use common\components\SeoComponent;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\models\News;
use yii\data\Pagination;


class NewsController extends \common\components\BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view'],
                'rules' => [

                    [
                        'actions' => ['index', 'view','save-new-feedback'],
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'view' => ['get'],
                    'index' => ['get'],
                    'save-new-feedback' => ['post'],
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
        SeoComponent::setByTemplate('news', [
            'name' => 'Акции',
        ]);
        $news = News::find()->andWhere(['status'=>1]);
        $posts_count_query = clone $news;
        $pages = new Pagination(['totalCount' => $posts_count_query->count(), 'pageSize' => 1]);

        $news = $news->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('sort DESC')
            ->all();
        return $this->render('index.twig',[
            'news' => $news,
            'pages'     => $pages
        ]);
    }

    public function actionView($alias)
    {
        $news=News::find()->byAlias($alias)->andWhere(['status'=>1])->joinWith('info')->limit(1)->one();
        SeoComponent::setByTemplate('news', [
            'name' => $news->info->title
        ]);
        if(empty($news))
        {
            throw new NotFoundHttpException();
        }
        return $this->render('view.twig', [
            'news' => $news,
        ]);
    }

    public function actionSaveNewFeedback()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if(!$request->isAjax)
        {
            throw new BadRequestHttpException("Wrong request", 400);
        }
        $post                   = $request->post();
        $model                  = new \common\models\NewsFeedbacks();
        $model->name            = isset($post['name']) ? strip_tags($post['name']) : '';
        $model->text            = isset($post['text']) ? strip_tags($post['text']) : '';
        $model->status          = 0;
        $model->parent_id       = isset($post['id']) ? strip_tags($post['id']) : '';
        $model->creation_time   = date('U');
        if($model->save())
        {
            return ['answer'=>'success'];
        }
        else {
            foreach ($model->errors as $error)
            {
                return $error[0];
            }
        }
    }

}
