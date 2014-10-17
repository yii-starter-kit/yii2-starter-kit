<?php
$config = \yii\helpers\ArrayHelper::merge(
    require(__DIR__.'/_base.php'),
    [
        'controllerNamespace' => 'backend\controllers',
        'defaultRoute'=>'system-information/index',
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
                        'name'   => ['category' => 'app','message' => 'Uploads'], // Yii::t($category, $message)
                        'access' => ['read' => 'manager', 'write' => 'manager'] // * - для всех, иначе проверка доступа в даааном примере все могут видет а редактировать могут пользователи только с правами UserFilesAccess
                    ]
                ]
            ]
        ],
        'modules'=>[
            'i18n' => [
                'class' => 'backend\modules\i18n\Module', //todo: Allow to manager, disallow other
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
                    'allow' => false,
                    'roles' => ['manager'],
                ],
                [
                    'controllers'=>['user'],
                    'allow' => true,
                    'roles' => ['administrator'],
                ],
                [
                    'allow' => true,
                    'roles' => ['manager'],
                ]
            ]
        ]
    ]
);

return $config;
