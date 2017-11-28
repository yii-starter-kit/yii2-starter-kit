<?php
// Bootstrapping tests environment
require(__DIR__ . '/../../tests/bootstrap.php');

// NOTE: Make sure this file is not accessible when deployed to production
if (YII_ENV !== 'test') {
    die('You are not allowed to access this file.');
}

// TEST ENV
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'test');

// Environment
require(__DIR__ . '/../../common/env.php');

// Yii
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

// Bootstrap application
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = require(__DIR__ . '/../../tests/config/frontend/acceptance.php');

(new yii\web\Application($config))->run();
