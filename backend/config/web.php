<?php
$config = [
    'homeUrl'=>Yii::getAlias('@backendUrl'),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute'=>'system-event/timeline',
    'controllerMap'=>[
        'file-manager-elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['manager'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
            'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
            'roots' => [
                [
                    'baseUrl' => '@storageUrl',
                    'basePath' => '@storage',
                    'path'   => '/uploads',
                    'access' => ['read' => 'manager', 'write' => 'manager'] // * - для всех, иначе проверка доступа в даааном примере все могут видет а редактировать могут пользователи только с правами UserFilesAccess
                ]
            ]
        ]
    ],
    'components'=>[
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl'=>['sign-in/login'],
            'enableAutoLogin' => true,
        ],
    ],
    'modules'=>[
        'i18n' => [
            'class' => 'backend\modules\i18n\Module',
            'defaultRoute'=>'i18n-message/index'
        ]
    ],
    'as globalAccess'=>[
        'class'=>'\common\components\behaviors\GlobalAccessBehavior',
        'rules'=>[
            [
                'controllers'=>['sign-in'],
                'allow' => true,
                'roles' => ['?'],
                'actions'=>['login']
            ],
            [
                'controllers'=>['site'],
                'allow' => true,
                'roles' => ['?'],
                'actions'=>['error']
            ],
            [
                'controllers'=>['debug/default'],
                'allow' => true,
                'roles' => ['?'],
            ],
            [
                'controllers'=>['user'],
                'allow' => true,
                'roles' => ['administrator'],
            ],
            [
                'controllers'=>['user'],
                'allow' => false,
            ],
            [
                'allow' => true,
                'roles' => ['manager'],
            ]
        ]
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'generators'=>[
            'crud'=>[
                'class'=>'yii\gii\generators\crud\Generator',
                'templates'=>[
                    'yii2-starter-kit'=>Yii::getAlias('@backend/views/_gii/templates')
                ],
                'messageCategory'=>'backend'
            ]
        ]
    ];
}

return $config;
