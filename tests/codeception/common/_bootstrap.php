<?php
require_once( __DIR__ . '/../../bootstrap.php');

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

defined('YII_APP_BASE_PATH') or define('YII_APP_BASE_PATH', dirname(dirname(dirname(__DIR__))));

// Prepare Yii
require_once(YII_APP_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');
require_once(YII_APP_BASE_PATH . '/common/config/bootstrap.php');

// set correct script paths
$_SERVER['SERVER_NAME'] = 'localhost';
$_SERVER['SERVER_PORT'] = '8080';

$config = require(__DIR__ . '/../config/common/unit.php');
new yii\web\Application($config);

Yii::setAlias('@tests', dirname(dirname(__DIR__)));
