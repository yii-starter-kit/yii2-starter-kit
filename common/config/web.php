<?php
$base = require('_base.php');
$config = [
    'bootstrap' => ['log'],
    'defaultRoute'=>'system-information/index',
    'components' => [
        'assetManager'=>[
            'class'=>'yii\web\AssetManager',
            'linkAssets'=>true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'loginUrl'=>['user/login'],
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
    'as language'=>[
        'class'=>'common\components\behaviors\LanguageBehavior'
    ],
    'params' => [
        'adminEmail' => 'webmaster@example.com',
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class'=>'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module'
    ];
}

$config = yii\helpers\ArrayHelper::merge($base, $config);

return $config;
