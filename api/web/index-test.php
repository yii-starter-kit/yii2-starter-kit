<?php
require(__DIR__ . '/../../tests/bootstrap.php');

// NOTE: Make sure this file is not accessible when deployed to production
if (YII_ENV !== 'test') {
    die('You are not allowed to access this file.');
}

// Environment
require(__DIR__ . '/../../common/env.php');

// Yii
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

// Bootstrap application
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/base.php'),
    require(__DIR__ . '/../../common/config/web.php'),
    require(__DIR__ . '/../config/base.php'),
    require(__DIR__ . '/../config/web.php'),
    require(__DIR__ . '/../../tests/config/base.php'),
    require(__DIR__ . '/../../tests/config/common/acceptance.php'),
    require(__DIR__ . '/../../tests/config/frontend/acceptance.php')
);

(new yii\web\Application($config))->run();
