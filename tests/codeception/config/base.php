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
            'dsn' => 'mysql:host=localhost;dbname=yii2-starter-kit_tests',
            'username' => 'root'
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
