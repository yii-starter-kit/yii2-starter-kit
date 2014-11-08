<?php
return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'console\controllers',
    'controllerMap'=>[
        'message'=>[
            'class'=>'console\controllers\ExtendedMessageController'
        ],
        'migrate'=>[
            'class'=>'yii\console\controllers\MigrateController',
            'migrationPath'=>'@common/migrations',
            'migrationTable'=>'{{%system_migration}}'
        ],
        'rbac'=>[
            'class'=>'console\controllers\RbacController'
        ]
    ],
];
