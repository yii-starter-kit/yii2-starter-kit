<?php
$config = [
    'components' => [
        'assetManager'=>[
            'class'=>'yii\web\AssetManager',
            'linkAssets'=>true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'rbac_auth_item',
            'itemChildTable' => 'rbac_auth_item_child',
            'assignmentTable' => 'rbac_auth_assignment',
            'ruleTable' => 'rbac_auth_rule',
            'defaultRoles' => ['administrator', 'manager', 'user'],
        ],
    ],
    'as locale'=>[
        'class'=>'common\components\behaviors\LocaleBehavior'
    ],
];

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
    ];
}

return $config;
