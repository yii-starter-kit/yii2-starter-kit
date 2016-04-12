<?php
/**
 * Application configuration shared by all applications and test types
 */
return [
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'fixtureDataPath' => '@tests/common/fixtures/data',
            'templatePath' => '@tests/common/templates/fixtures',
            'namespace' => 'tests\common\fixtures',
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
];
