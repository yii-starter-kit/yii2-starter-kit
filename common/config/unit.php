<?php
/**
 * Application configuration shared by all applications unit tests
 */

return yii\helpers\ArrayHelper::merge(
    require('base.php'),
    [
        'id' => 'app-common',
        'basePath' => dirname(__DIR__),
        'controllerMap' => [
            'fixture' => [
                'class' => 'yii\faker\FixtureController',
                'fixtureDataPath' => '@common/fixtures/data',
                'templatePath' => '@common/templates/fixtures',
                'namespace' => '@common\fixtures',
            ],
        ],

        'components' => [
            'db' => [
                'dsn' => env('TEST_DB_DSN'),
                'username' => env('TEST_DB_USERNAME'),
                'password' => env('TEST_DB_PASSWORD')
            ],
            'mailer' => [
                'useFileTransport' => true,
            ],
            'urlManager' => [
                'showScriptName' => true,
            ],
        ],
    ]
);