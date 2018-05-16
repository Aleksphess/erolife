<?php

namespace frontend\controllers;
use Yii;

use common\models\CatalogCategories;
use common\models\CatalogProducts;


class SitemapController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = false;
        $host = Yii::$app->request->hostInfo;
        header('Content-type: text/xml');
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $response->headers->set('Content-Type', 'text/xml');
        $urls = [];

        // Страницы

        // Catalog
        $products = CatalogProducts::find()->all();
        foreach ($products as $product){
            $urls[] = $product->url;
        }

        // Catalog Categories
        $catalog_cats = CatalogCategories::find()->all();
        foreach ($catalog_cats as $catalog_cat){
            $urls[] = $catalog_cat->url;
        }


        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        foreach ($urls as $url){
            echo '<url>
                <loc>' . $url . '</loc>
                <changefreq>daily</changefreq>
                <priority>0.5</priority>
            </url>';
        }
        echo '</urlset>';
        Yii::$app->end();
    }


}
