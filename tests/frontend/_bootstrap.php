<?php
require_once(__DIR__ . '/../bootstrap.php');

// Prepare Yii
require_once(YII_APP_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');
require_once(YII_APP_BASE_PATH . '/common/config/bootstrap.php');
require_once(YII_APP_BASE_PATH . '/frontend/config/bootstrap.php');

Yii::setAlias('@tests', dirname(__DIR__));

$config = require(YII_APP_BASE_PATH . '/tests/config/frontend/functional.php');
if (!isset($config['id'])) {
    $config['id'] = 'app-tests';
}
new yii\web\Application($config);
