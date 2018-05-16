<?php

namespace frontend\controllers;

use common\components\SeoComponent;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\models\Discounts;
use yii\data\Pagination;


class DiscountController extends \common\components\BaseController
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
                        'actions' => ['index', 'view'],
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
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        SeoComponent::setByTemplate('discount', [
            'name' => 'Акции',
        ]);
        $discounts = Discounts::find()->andWhere(['status'=>1]);
        $posts_count_query = clone $discounts;
        $pages = new Pagination(['totalCount' => $posts_count_query->count(), 'pageSize' => 1]);

        $discounts = $discounts->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('sort DESC')
            ->all();
        return $this->render('index.twig',[
            'discounts'=>$discounts,
            'pages'     => $pages
        ]);
    }

    public function actionView($alias)
    {
        $discount=Discounts::find()->byAlias($alias)->andWhere(['status'=>1])->joinWith('info')->limit(1)->one();
        SeoComponent::setByTemplate('discount', [
            'name' => $discount->info->title
        ]);
        if(empty($discount))
        {
            throw new NotFoundHttpException();
        }
        return $this->render('view.twig', [
            'discount'=>$discount
        ]);
    }

}
