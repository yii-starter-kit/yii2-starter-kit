<?php

use yii\db\Connection;

/**
 * Application configuration shared by all applications and test types
 */
return [
    'components' => [
        'db' => [
            'class' => Connection::class,
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
