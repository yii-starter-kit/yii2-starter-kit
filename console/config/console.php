<?php
require('_bootstrap.php');
return [
        'id' => 'console',
        'basePath' => dirname(__DIR__),
        'controllerNamespace' => 'console\controllers',
        'bootstrap' => ['log'],
        'controllerMap'=>[
            'migrate'=>[
                'class'=>'yii\console\controllers\MigrateController',
                'migrationPath'=>'@common/migrations',
                'migrationTable'=>'{{%system_migration}}'
            ],
            'message-migrate'=>[
                'class'=>'console\controllers\MessageMigrateController'
            ]
        ],
        'components' => [
            'cache' => [
                'class' => 'yii\caching\FileCache',
            ],
        ],
];
