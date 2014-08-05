<?php
require('_aliases.php');
return [
    'name'=>'Yii2 Starter Kit',
    'vendorPath'=>dirname(dirname(__DIR__)).'/vendor',
    'extensions' => require(dirname(__DIR__) . '/../vendor/yiisoft/extensions.php'),
    'sourceLanguage'=>'en-US',
    'language'=>'en-US',
    'components' => [

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'rbac_auth_item',
            'itemChildTable' => 'rbac_auth_item_child',
            'assignmentTable' => 'rbac_auth_assignment',
            'ruleTable' => 'rbac_auth_rule',
            'defaultRoles' => ['administrator', 'manager', 'user'],
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except'=>['yii\web\HttpException:404'], // todo: DbTarget для 404 и 403
                    'logVars'=>[],
                    'logTable'=>'{{%system_log}}'
                ]
            ],
        ],

        'i18n' => [
            'translations' => [
                '*'=> [
                    'class' => 'yii\i18n\DbMessageSource',
                    'sourceMessageTable'=>'{{%i18n_source_message}}',
                    'messageTable'=>'{{%i18n_message}}',
                    'cachingDuration'=>60
                ],
            ],
        ],

        'fileStorage'=>[
            'class'=>'common\components\fileStorage\FileStorage',
            'defaultRepository'=>'filesystem',
            'repositories'=>[
                [
                    'class'=>'common\components\fileStorage\repository\FilesystemRepository',
                    'basePath'=>'@storage/uploads',
                    'baseUrl'=>'@storageUrl/uploads',
                ]
            ],

        ],

        'keyStorage'=>[
            'class'=>'common\components\keyStorage\KeyStorage'
        ],

        'urlManager'=>[
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl'=>true,
            'showScriptName'=>false,
            'rules'=> require('_urlRules.php')
        ],
    ],
    'params' => [
        'adminEmail' => 'admin@example.com',
    ],
];
