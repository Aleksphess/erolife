<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/style.css',
        '/css/owl.theme.default.min.css',
        '/css/owl.carousel.min.css',
        '/css/lightbox.css',

    ];
    public $js = [
        '/js/jquery.js',
        //    'js/main2.js',
       'https://www.google.com/recaptcha/api.js',

        '/js/main.js',
        '/js/owl.carousel.js',
        '/js/lightbox.js',
        '/js/script.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
