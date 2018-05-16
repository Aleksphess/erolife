<?php

namespace frontend\widgets;

use Yii;
use common\models\Menu;



class BottomMenu extends \yii\base\Widget
{
    public $menu_bottom = false;

    public function run()
    {



            $menu = Menu::find()->orderBy('sort DESC')->all();
            return $this->render('bottom/menu.twig', [
                'menu'        => $menu,
            ]);


    }
}