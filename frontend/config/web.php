<?php
$config = [
    'homeUrl'=>Yii::getAlias('@frontendUrl'),
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index',
    'modules' => [
        'user' => [
            'class' => 'frontend\modules\user\Module'
        ],
        'api' => [
            'class' => 'frontend\modules\api\Module',
            'modules' => [
                'v1' => 'frontend\modules\api\v1\Module'
            ]
        ]
    ],
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'github' => [
                    'class' => 'yii\authclient\clients\GitHub',
                    'clientId' => getenv('GITHUB_CLIENT_ID'),
                    'clientSecret' => getenv('GITHUB_CLIENT_SECRET')
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => getenv('FACEBOOK_CLIENT_ID'),
                    'clientSecret' => getenv('GITHUB_CLIENT_SECRET'),
                    'scope' => 'email,public_profile',
                    'attributeNames' => [
                        'name',
                        'email',
                        'first_name',
                        'last_name',
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'request' => [
            'cookieValidationKey' => getenv('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl'=>['/user/sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
        ]
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'generators'=>[
            'crud'=>[
                'class'=>'yii\gii\generators\crud\Generator',
                'messageCategory'=>'frontend'
            ]
        ]
    ];
}

if (YII_ENV_PROD) {
    // Maintenance mode
    $config['bootstrap'] = ['maintenance'];
    $config['components']['maintenance'] = [
        'class' => 'common\components\maintenance\Maintenance',
        'enabled' => function ($app) {
            return $app->keyStorage->get('frontend.maintenance') === 'enabled';
        }
    ];

    // Compressed assets
    //$config['components']['assetManager'] = [
    //   'bundles' => require(__DIR__ . '/assets/_bundles.php')
    //];
}

return $config;
