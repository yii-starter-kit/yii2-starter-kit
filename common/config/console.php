<?php

$base = require(__DIR__ . '/_base.php');

return \yii\helpers\ArrayHelper::merge(
    $base,
    [
        'id' => 'basic-console',
        'controllerNamespace' => 'console\controllers',
        'components' => [
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
