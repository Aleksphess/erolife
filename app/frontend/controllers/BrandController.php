<?php
namespace frontend\controllers;


use common\components\BaseController;
use common\models\Brands;
use common\components\SeoComponent;
use yii\filters\VerbFilter;






class BrandController extends BaseController
{
    public function behaviors() {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                   'index'  => ['get'],
                   'view'   => ['get'],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $brands = Brands::find()->active()->all();
        SeoComponent::setByTemplate('brands', [
            'name' => 'Бренды',
        ]);
        return $this->render('index.twig', [
            'brands'    => $brands,
        ] );
    }

    public function actionView($alias)
    {
        $brand = Brands::find()->active()->byAlias($alias)->limit(1)->one();
        SeoComponent::setByTemplate('brands', [
            'name' => $brand->info->title,
        ]);
        if(empty($brand))
        {
            throw new NotFoundHttpException();
        }
        return $this->render('view.twig', [
            'brand'     => $brand,
        ]);
    }
}