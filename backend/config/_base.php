<?php
require('_bootstrap.php');
return [
    'id' => 'backend',
    'basePath' => dirname(__DIR__),
    'components' => [
        'authManager' => [
            'defaultRoles' => ['administrator', 'manager', 'user'],
        ],

        'urlManager'=>require(__DIR__.'/_urlManager.php'),

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'request'=>[
            'cookieValidationKey'=>'yii2-starter-kit.backend',
        ],
    ],
];