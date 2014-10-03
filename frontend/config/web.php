<?php
$config = [
    'id' => 'frontend',
    'basePath'=>dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/index',
    'components' => [
        'authManager' => [
            'defaultRoles' => ['administrator', 'manager', 'user'],
        ],

        'user' => [
            'loginUrl'=>'/user/sign-in/login',
            'enableAutoLogin' => true,
        ],

        'request'=>[
            'cookieValidationKey'=>'yii2-starter-kit.frontend',
        ],

        'urlManager'=>[
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl'=>true,
            'showScriptName'=>false,
            'rules'=> require('_urlRules.php')
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module',
        ],
    ],
];

return $config;