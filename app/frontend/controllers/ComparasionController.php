<?php
namespace frontend\controllers;

use common\models\CatalogCategories;
use Yii;
use common\components\BaseController;
use common\models\CatalogProducts;

use common\components\SeoComponent;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;






class ComparasionController extends BaseController
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

                    'index' => ['get'],
                    'add' => ['post'],
                    'delete'    => ['post']

                ]
            ]
        ];
    }
    public function actionIndex()
    {
        $alias = Yii::$app->request->get('alias');
        SeoComponent::setByTemplate('default', [
            'name' => $this->view->params['backet'],
        ]);
        if(isset($_SESSION['comparasion']) and !empty($_SESSION['comparasion']))
        {

            foreach ($_SESSION['comparasion'] as $id=>$count)
            {

                $categories [] = CatalogProducts::find()->byId($id)->limit(1)->one()->parent->id;
            }
            $categories = array_unique($categories);
            $categories_two = [];
            foreach ($categories as $category)
            {
                $categories_two [] = CatalogCategories::find()->byId($category)->limit(1)->one();
            }
            $categories = $categories_two;
                if(is_null($alias))
                {
                    foreach ($categories as $category)
                    {
                        $idsForCatalog = $category->idsForCatalog;
                        //	Все значения фильтра в текущей категории
                        $filt = \common\models\ExtraParamsCache::getCategoryFilter($idsForCatalog, $filter) ;
                        break;
                    }
                    $products = [];
                    foreach ($categories as $category)
                    {
                        foreach ($_SESSION['comparasion'] as $id=>$count)
                        {
                            $product = CatalogProducts::find()->byId($id)->limit(1)->one();
                            if($product->cat_id==$category->id)
                            {

                                $products [] = $product;
                            }
                        }break;
                    }
                }
                else
                {
                    $category = \common\models\CatalogCategories::find()->andWhere(['name_alt'=>$alias])->limit(1)->one();
                    $idsForCatalog = $category->idsForCatalog;
                    //	Все значения фильтра в текущей категории
                    $filt = \common\models\ExtraParamsCache::getCategoryFilter($idsForCatalog, $filter);
                    $products = [];

                        foreach ($_SESSION['comparasion'] as $id=>$count)
                        {
                            $product = CatalogProducts::find()->byId($id)->limit(1)->one();
                            if($product->cat_id==$category->id)
                            {

                                $products [] = $product;
                            }
                        }
                }



            return $this->render('index.twig',[
                'products' => $products,
                'categories'    => $categories,
                'filter'        => $filt,
                'alias'         => $alias
            ]);
        }
        return $this->render('empty.twig');


    }

    public function actionAdd()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            throw new BadRequestHttpException();
        }
        $post = $request->post();

        if ( $post['id'] > 0)
        {
            if(!isset($_SESSION['comparasion']))
            {
                $_SESSION['comparasion'] = [];
                $_SESSION['comparasion'][$post['id']] = 1;
            }
            else
            {
                if(isset($_SESSION['comparasion'][$post['id']]))
                {
                    unset($_SESSION['comparasion'][$post['id']]);
                }
                else
                {
                    $_SESSION['comparasion'][$post['id']] = 1;
                }
            }
        }
       return ['answer' => true];
    }

    public function actionDelete()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            throw new BadRequestHttpException();
        }
        $post = $request->post();

        if ( $post['id'] > 0)
        {
                    unset($_SESSION['comparasion'][$post['id']]);
        }
        return ['answer' => true,'url'=>Url::toRoute('/comparasion')];
    }



}