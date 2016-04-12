<?php
// Require core files
require(__DIR__ . '/../helpers.php');

// Init application constants
defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'prod'));

// Path aliases
Yii::setAlias('@base', realpath(__DIR__.'/../../'));
Yii::setAlias('@common', realpath(__DIR__.'/../../common'));
Yii::setAlias('@frontend', realpath(__DIR__.'/../../frontend'));
Yii::setAlias('@backend', realpath(__DIR__.'/../../backend'));
Yii::setAlias('@console', realpath(__DIR__.'/../../console'));
Yii::setAlias('@storage', realpath(__DIR__.'/../../storage'));
Yii::setAlias('@tests', realpath(__DIR__.'/../../tests'));

// Url Aliases
Yii::setAlias('@frontendUrl', env('FRONTEND_URL'));
Yii::setAlias('@backendUrl', env('BACKEND_URL'));
Yii::setAlias('@storageUrl', env('STORAGE_URL'));



