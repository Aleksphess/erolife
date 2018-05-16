<?php

namespace frontend\widgets;

use Yii;
use common\models\CatalogProducts;



class Soups extends \yii\base\Widget
{


    public function run()
    {
        $products = CatalogProducts::find()->soups()->limit(4)->all();
        return $this->render('soups/view.twig',[
            'products'  => $products,
        ]);
    }

}