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

        'formatter'=>[
            'class'=>'yii\i18n\Formatter'
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except'=>['yii\web\HttpException:404', 'yii\i18n\I18N::format'], // todo: DbTarget для 404 и 403
                    'prefix'=>function($message){
                        $traces = $message[4];
                        $file = \yii\helpers\ArrayHelper::getValue($traces, 'file', 'unknown');
                        $line = \yii\helpers\ArrayHelper::getValue($traces, 'line', 'unknown');
                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                        return sprintf('[%s][%s][%s]', Yii::$app->id, $url, implode(':', [$file, $line]));
                    },
                    'logVars'=>[],
                    'logTable'=>'{{%system_log}}'
                ]
            ],
        ],

        'i18n' => [
            'translations' => [
                '*'=> [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath'=>'@common/messages',
                    'fileMap'=>[
                        'common'=>'common.php',
                        'backend'=>'backend.php',
                        'frontend'=>'frontend.php',
                    ]
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
        'availableLocales'=>[
            'en-US'=>'English (US)',
            'ru-RU'=>'Русский (РФ)',
            'ua-UA'=>'Українська (Україна)'
        ],
    ],
];
