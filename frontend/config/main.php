<?php
$base = require('_base.php');
$config = [
    'id' => 'frontend',
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/index',
    'modules'=>[
        'manager' => [
            'class' => 'frontend\modules\manager\Module',
            'controllerMap'=>[
                'file-manager-elfinder' => [
                    'class' => 'mihaildev\elfinder\Controller',
                    'access' => ['manager'], //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем ['@', '?']
                    'disabledCommands' => ['netmount'], //отключение ненужных команд https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#commands
                    'roots' => [
                        [
                            'path'   => '/uploads',
                            'name'   => ['category' => 'app','message' => 'Uploads'], // Yii::t($category, $message)
                            'access' => ['read' => 'manager', 'write' => 'manager'] // * - для всех, иначе проверка доступа в даааном примере все могут видет а редактировать могут пользователи только с правами UserFilesAccess
                        ]
                    ]
                ]
            ],
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'loginUrl'=>['user/login'],
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ],
        'request'=>[
            'cookieValidationKey'=>md5('yii2-starter-kit')
        ],
    ],
    'params' => [
        'adminEmail' => 'webmaster@example.com',
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

$config = yii\helpers\ArrayHelper::merge(
    $base,
    $config
);

return $config;
