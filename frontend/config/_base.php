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

        'urlManager'=>require(__DIR__.'/_urlManager.php'),
    ],
];