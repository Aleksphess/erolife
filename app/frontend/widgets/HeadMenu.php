<?php

namespace frontend\widgets;

use common\models\CatalogCategories;
use Yii;




class HeadMenu extends \yii\base\Widget
{


    public function run()
    {

        $menu = CatalogCategories::find()->where(['parent_id'=>-1])->all();

            return $this->render('head/menu.twig', [
                'menu'        => $menu,
            ]);


    }
}