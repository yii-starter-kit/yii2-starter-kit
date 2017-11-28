<?php
require_once(__DIR__ . '/../bootstrap.php');

// Prepare Yii
require_once(YII_APP_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');
require_once(YII_APP_BASE_PATH . '/common/config/bootstrap.php');
require_once(YII_APP_BASE_PATH . '/console/config/bootstrap.php');

// set correct script paths
$_SERVER['SERVER_NAME'] = 'localhost';
$_SERVER['SERVER_PORT'] = '80';

Yii::setAlias('@tests', dirname(__DIR__));
