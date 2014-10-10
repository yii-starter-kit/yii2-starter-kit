<?php
require('_bootstrap.php');
return [
    'name'=>'Yii2 Starter Kit',
    'vendorPath'=>dirname(dirname(__DIR__)).'/vendor',
    'extensions' => require(dirname(__DIR__) . '/../vendor/yiisoft/extensions.php'),
    'sourceLanguage'=>'en-US',
    'language'=>'en-US',
    'bootstrap' => ['log'],
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

        'db'=>[
            'class'=>'yii\db\Connection'
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db'=>[
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'except'=>['yii\web\HttpException', 'yii\i18n\I18N'],
                    'prefix'=>function(){
                        $url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
                        return sprintf('[%s][%s]', Yii::$app->id, $url);
                    },
                    'logVars'=>[],
                    'logTable'=>'{{%system_log}}'
                ]
            ],
        ],

        'i18n' => [
            'translations' => [
                'app'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath'=>'@common/messages',
                ],
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
            'class'=>'trntv\filekit\storage\FileStorage',
            'repositories'=>[
                'uploads'=>[
                    'class'=>'trntv\filekit\storage\repository\FilesystemRepository',
                    'basePath'=>'@storage',
                    'baseUrl'=>'@storageUrl',
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
            'uk-UA'=>'Українська (Україна)'
        ],
    ],
];
