<?php
// Composer
require(__DIR__ . '/../../vendor/autoload.php');

// Environment
require(__DIR__ . '/../../common/env.php');

// Yii
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

// Bootstrap application
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');

$config = \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/base.php'),
    require(__DIR__ . '/../../common/config/web.php'),
    require(__DIR__ . '/../config/base.php'),
    require(__DIR__ . '/../config/web.php')
);

(new yii\web\Application($config))->run();
