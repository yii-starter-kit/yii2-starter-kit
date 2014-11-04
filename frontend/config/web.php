<?php
$config = \yii\helpers\ArrayHelper::merge(
    require(__DIR__.'/_base.php'),
    [
        'homeUrl'=>Yii::getAlias('@frontendUrl'),
        'controllerNamespace' => 'frontend\controllers',
        'defaultRoute' => 'site/index',
        'modules' => [
            'user' => [
                'class' => 'frontend\modules\user\Module',
            ],
        ],
        'components' => [
            'authClientCollection' => [
                'class' => 'yii\authclient\Collection',
            ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            'user' => [
                'class'=>'yii\web\User',
                'identityClass' => 'common\models\User',
                'loginUrl'=>['/user/sign-in/login'],
                'enableAutoLogin' => true,
            ],
        ]
    ]
);

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class'=>'yii\debug\Module',
        'allowedIPs' => ['*'],
        'panels'=>[
            'xhprof'=>[
                'class'=>'\trntv\debug\xhprof\panels\XhprofPanel'
            ]
        ]
    ];

    $config['bootstrap'][] = 'gii';
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
return $config;