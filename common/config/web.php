<?php
$config = [
    'components' => [
        'assetManager'=>[
            'class'=>'yii\web\AssetManager',
            'linkAssets'=>true,
        ]
    ],
    'as locale'=>[
        'class'=>'common\components\behaviors\LocaleBehavior'
    ],
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class'=>'yii\debug\Module',
        'allowedIPs' => ['*'],
        /*'panels'=>[
            'xhprof'=>[
                'class'=>'\trntv\debug\xhprof\panels\XhprofPanel'
            ]
        ]*/
    ];
}

return $config;
