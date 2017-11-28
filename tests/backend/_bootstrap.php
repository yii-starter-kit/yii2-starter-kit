<?php
require_once(__DIR__ . '/../bootstrap.php');

// Prepare Yii
require_once(YII_APP_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');
require_once(YII_APP_BASE_PATH . '/common/config/bootstrap.php');
require_once(YII_APP_BASE_PATH . '/backend/config/bootstrap.php');

Yii::setAlias('@tests', dirname(__DIR__));
