<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id'                    => 'app-frontend',
    'name'                  => 'Dashboard',
    'basePath'              => dirname(__DIR__),
    'bootstrap'             => ['log'],
    'controllerNamespace'   => 'frontend\controllers',
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ],

        'request' => [
            'csrfParam'     => 'digital_force',
            'baseUrl'       => '/',
            'class'               => 'common\components\LangRequest', // for multiLang
            'cookieValidationKey' => 'NtC8TLEAnI8DYwWjrjdaauocn_HQfZ-p',
        ],
        'liqpay' => [
            'class' => 'common\components\LiqPay',
        ],
        'user'   => [
            'identityClass'     => 'common\models\User',
            'enableAutoLogin'   => false,
            'identityCookie'    => ['name' => '_identity-frontend', 'httpOnly' => false],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel'    => YII_DEBUG ? 3 : 0,
            'targets'       => [
                [
                    'class'     => 'yii\log\FileTarget',
                    'levels'    => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'class'               => 'common\components\LangUrlManager', // for multiLang
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => false,
          //  'suffix'              => '',
            'rules' => [
              

                [
                    'pattern'   => '',
                    'route'     => 'content/index',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'sitemap',
                    'route'     => 'sitemap/index',
                    'suffix'    => '.xml'
                ],
                [
                    'pattern'   => 'signin',
                    'route'     => 'content/signin',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'login',
                    'route'     => 'content/login',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'save-new-product-feedback',
                    'route'     => 'catalog/save-new-feedback',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'save-new-feedback',
                    'route'     => 'news/save-new-feedback',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'news/<alias>',
                    'route'     => 'news/view',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'news/page/<page>',
                    'route'     => 'news/index',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'news',
                    'route'     => 'news/index',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'success',
                    'route'     => 'cart/success',
                    'suffix'    => '',
                ],

                [
                    'pattern'   => 'discounts/<alias>',
                    'route'     => 'discount/view',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'discounts/page/<page>',
                    'route'     => 'discount/index',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'discounts',
                    'route'     => 'discount/index',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'brands/<alias>',
                    'route'     => 'brand/view',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'brands',
                    'route'     => 'brand/index',
                    'suffix'    => '',
                ],
                [
                    'pattern'   => 'iiko',
                    'route'     => 'content/iiko',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'orders_<id>',
                    'route'     => 'cart/orders',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/change-topic-backet',
                    'route'     => 'cart/change-topic-backet',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/change-topic',
                    'route'     => 'cart/change-topic',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/stop',
                    'route'     => 'cart/stop',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/repick-order',
                    'route'     => 'cart/repick-order',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => '/cart/promo',
                    'route'     => 'cart/promo',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => '/cart/save-order',
                    'route'     => 'cart/save-order',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'comparasion/<alias>',
                    'route'     => 'comparasion/index',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'form/callback',
                    'route'     => 'forms/callback',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'form/feedback',
                    'route'     => 'forms/feedback',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'form/subscription',
                    'route'     => 'forms/subscription',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'favorite/delete',
                    'route'     => '/user/delete-favorite',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'favorite/add',
                    'route'     => 'favorite/add',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'comparasion',
                    'route'     => 'comparasion/index',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'delete-comparison',
                    'route'     => 'comparasion/delete',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'add-comparison',
                    'route'     => 'comparasion/add',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'order',
                    'route'     => 'cart/order',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'backet',
                    'route'     => 'cart/backet',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/delete-from-backet-ajax',
                    'route'     => 'cart/delete-from-backet-ajax',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/change-address',
                    'route'     => 'cart/change-address',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/change-count-ajax',
                    'route'     => 'cart/change-count-ajax',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/delete-from-backet',
                    'route'     => 'cart/delete-from-backet',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/change-count',
                    'route'     => 'cart/change-count',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/request-product',
                    'route'     => 'cart/request-product',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/clear',
                    'route'     => 'cart/clear',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'cart/request',
                    'route'     => 'cart/request',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'logout',
                    'route'     => 'auth/logout',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'user/index',
                    'route'     => 'user/index',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'user/change-address',
                    'route'     => 'user/change-address',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'user/add-address',
                    'route'     => 'user/add-address',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'user/change-password',
                    'route'     => 'user/change-password',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'user/change-settings',
                    'route'     => 'user/change-settings',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => '/reset/<id>',
                    'route'     => 'content/reset-password',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'auth/reset',
                    'route'     => 'auth/reset',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'auth/reset-password',
                    'route'     => 'auth/reset-password',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'auth/sign-in',
                    'route'     => 'auth/sign-in',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'auth/sign-up',
                    'route'     => 'auth/sign-up',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'forgot',
                    'route'     => 'content/forgot',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'login',
                    'route'     => 'content/login',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'discounts/<alias>',
                    'route'     => 'discount/view',
                    'suffix'    => ''
                ],
                [
                    'pattern'   => 'discounts',
                    'route'     => 'discount/index',
                    'suffix'    => ''
                ],

                [
                    'pattern'   => '<alias:about|contacts|payment|delivery|materials|useful|size-table>',
                    'route'     => 'content/static',
                    'suffix'    => ''
                ],

                [
                    'pattern' => '<alias>/<name_alt>',
                    'route'   => 'catalog/product',
                    'suffix'  => '',
                ],
                [
                    'pattern' => '<alias>/filter/<filter>/page/<page>',
                    'route'   => 'catalog/category',
                    'suffix'  => '',
                ],
                [
                    'pattern' => '<alias>/filter/<filter>',
                    'route'   => 'catalog/category',
                    'suffix'  => '',
                ],
                [
                    'pattern' => '<alias>/page/<page>',
                    'route'   => 'catalog/category',
                    'suffix'  => '',
                ],
                [
                    'pattern' => '<alias>',
                    'route'   => 'catalog/category',
                    'suffix'  => '',
                ],
                [
                    'pattern'   => '<_c>/<_a>',
                    'route'     => '<_c>/<_a>',
                    'suffix'    => '',
                ],

            ],
        ],
        'language'     => 'ru-RU',
        'i18n'         => [
            'translations' => [
                '*' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
        // выключаем bootstap
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css'   => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'    =>[]
                ],
            ],
        ],
    ],
    'params' => $params,
];
