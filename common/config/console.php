<?php

$base = require(__DIR__ . '/_base.php');

return \yii\helpers\ArrayHelper::merge(
    $base,
    [
        'id' => 'basic-console',
        'basePath' => dirname(__DIR__),
        'bootstrap' => ['log'],
        'controllerNamespace' => 'console\controllers',
        'controllerMap'=>[
            'migrate'=>[
                'class'=>'yii\console\controllers\MigrateController',
                'migrationPath'=>'@app/console/migrations',
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
    ]
);
