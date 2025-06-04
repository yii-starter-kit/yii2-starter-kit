<?php
$config = [
    'components' => [
        'assetManager' => [
            'class' => yii\web\AssetManager::class,
            'linkAssets' => env('LINK_ASSETS'),
            'appendTimestamp' => YII_ENV_DEV
        ]
    ],
    'as locale' => [
        'class' => common\behaviors\LocaleBehavior::class,
        'enablePreferredLanguage' => true
    ],
    'container' => [
        'definitions' => [
           \yii\widgets\LinkPager::class => \yii\bootstrap4\LinkPager::class,
        ],
    ],
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        'allowedIPs' => ['*'],
    ];
}

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'allowedIPs' => ['*'],
    ];
}


return $config;
