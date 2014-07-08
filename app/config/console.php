<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$common = require(__DIR__ . '/common.php');

return \yii\helpers\ArrayHelper::merge(
    $common,
    [
        'id' => 'basic-console',
        'basePath' => dirname(__DIR__),
        'bootstrap' => ['log'],
        'controllerNamespace' => 'app\console\controllers',
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
