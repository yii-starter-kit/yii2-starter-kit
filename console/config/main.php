<?php
return [
        'id' => 'console',
        'basePath' => dirname(__DIR__),
        'controllerNamespace' => 'console\controllers',
        'bootstrap' => ['log'],
        'controllerMap'=>[
            'migrate'=>[
                'class'=>'yii\console\controllers\MigrateController',
                'migrationPath'=>'@console/migrations',
                'migrationTable'=>'{{%system_migration}}'
            ]
        ],
        'components' => [
            'cache' => [
                'class' => 'yii\caching\FileCache',
            ],
            'log' => [
                'targets' => [
                    [
                        'class' => 'yii\log\DbTarget',
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
        ],
];
