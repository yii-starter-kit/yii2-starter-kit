<?php
return [
    'components' => [
        'assetManager'=>[
            'class'=>'yii\web\AssetManager',
            'linkAssets'=>true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl'=>['sign-in/login'],
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ],
        'request'=>[
            'cookieValidationKey'=>md5('yii2-starter-kit')
        ],
    ],
    'as locale'=>[
        'class'=>'common\components\behaviors\LocaleBehavior'
    ],
];

