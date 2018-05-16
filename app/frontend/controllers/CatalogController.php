<?php

namespace frontend\controllers;

use Yii;
use yii\data\Pagination;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\components\SeoComponent;
use common\models\CatalogCategories;
use common\models\CatalogProducts;
use common\models\ExtraParamsCache;



class CatalogController extends \common\components\BaseController
{
    
       public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only'  => ['index', 'category', 'category-by-type'],
                'rules' => [
                    [
                        'actions'   => ['index', 'category', 'product','sort','type','save-new-feedback'],
                        'allow'     => true,
                        'roles'     => ['?', '@'],
                    ],
                ],
            ],
            'verbs' => [
                'class'     => VerbFilter::className(),
                'actions'   => [
                    'type'                      => ['get'],
                    'index'                     => ['get'],
                    'category'                  => ['get'],
                    'sort'                      => ['get'],
                    'product'                   => ['get'],
                    'filter'                    => ['get'],
                    'save-new-feedback'         => ['post'],

                ],
            ],
        ];
    }
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionCategory ($alias)
    {

        if (!preg_match("#^[aA-zZ0-9\-_]+$#",$alias)) {
            throw new NotFoundHttpException();
        }

        $category = CatalogCategories::find()->andWhere(['catalog_categories.name_alt'=>$alias])->joinWith('info')->limit(1)->one();
        $childs = $category->childs;

        if(empty($category)){
            throw new NotFoundHttpException();
        }
        $idsForCatalog = $category->idsForCatalog;
        //	Все значения фильтра в текущей категории
        $filt = ExtraParamsCache::getCategoryFilter($idsForCatalog, $filter);
        $selected = ExtraParamsCache::getSelected($filt);

        $query = CatalogProducts::find()
            ->orderBy('sort DESC')
            ->groupBy('`catalog_products`.`alias`')
            ->active()
            ->byCategoryIds($idsForCatalog);

        //	Количество всех товаров в категории
        $count_total = $query->count();

        //	Количество выбранных товаров
        $count_current = $count_total;
        /* var_dump($count_current);die();*/
        if ($selected)
        {
            //	Фильтрация товаров
            $query = $query->byFilter($selected);

            $count_current= $query->count();

        }

        //	Постраничная навигация
        $pages = new Pagination(['totalCount' => $count_current, 'pageSize' => 3]);

        //	Товары на странице
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        // if(empty($products)){return $this->render('empty.twig',['category'=>$category]);}


        if(!empty($selected))
        {
            $filter_text = '';
            $temp='';
            foreach ($selected as $filter_param)
            {
                //var_dump($filter_param);
                if($temp==$filter_param['param_name'])
                {
                    $filter_text .=$filter_param['value_name'].', ';
                    Yii::$app->view->registerMetaTag([
                        'name' => 'robots',
                        'content' => 'NOINDEX,NOFOLLOW'
                    ]);
                }
                else
                {
                    $filter_text .=$filter_param['param_name'].':'.$filter_param['value_name'].', ';

                }
                $temp=$filter_param['param_name'];
            }
            $filter_text = rtrim($filter_text, ", ");

            SeoComponent::setByTemplate('filter', [
                'name'   => $category->info->name.' '.$filter_text,

            ]);
            //  var_dump($filter);
            // это тоже часть СЕО-оптимизации
            $filter_array = explode('-or-', $filter);
            //  var_dump($filter_array);
             if(count($filter_array) > 1) {
                 Yii::$app->view->registerMetaTag([
                     'name' => 'robots',
                     'content' => 'NOINDEX,NOFOLLOW'
                 ]);
             }
        }
        else
        {
            SeoComponent::setByTemplate('catalog', [
                'name' => $category->info->name,
            ]);
        }
        //var_dump($filt);die();
        return $this->render('category.twig', [
            'category' => $category,
            'filter' => $filt,
            'pages' => $pages,
            'products' => $products,



        ]);

    }

    public function actionProduct ($alias,$name_alt)
    {



        $product = CatalogProducts::find()
            ->byAlias($name_alt)
            ->limit(1)
            ->one();
        $current_products = CatalogProducts::find()
            ->where(['id'=>explode(',',$product->also_ids)])
            ->all();
        SeoComponent::setByTemplate('product', [
            'name' => $product->info->name,
        ]);
        if (empty($product))
        {
            throw new NotFoundHttpException();
        }
        return $this->render('product.twig', [
       //     'category'  => $category,
            'product'      => $product,
            'current_products'  => $current_products,
            

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
        $model                  = new \common\models\ProductFeedbacks();
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