<?php
require('_bootstrap.php');
return [
    'id' => 'backend',
    'basePath' => dirname(__DIR__),
    'components' => [
        'authManager' => [
            'defaultRoles' => ['administrator', 'manager', 'user'],
        ],

        'urlManager'=>[
            'rules'=> require('_urlRules.php')
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'request'=>[
            'cookieValidationKey'=>'yii2-starter-kit.backend',
        ],
    ],
];