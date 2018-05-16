<?php

namespace frontend\widgets;

use Yii;
use common\models\CatalogProducts;



class Drinks extends \yii\base\Widget
{


    public function run()
    {
        $products = CatalogProducts::find()->drinks()->limit(4)->all();
        return $this->render('drinks/view.twig',[
            'products'  => $products,
        ]);
    }

}
