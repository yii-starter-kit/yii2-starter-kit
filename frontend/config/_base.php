<?php
require('_bootstrap.php');
return [
    'id' => 'frontend',
    'basePath'=>dirname(__DIR__),
    'bootstrap' => ['log'],
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
];