<?php

return yii\helpers\ArrayHelper::merge(
    require(YII_APP_BASE_PATH . '/common/config/base.php'),
    require(YII_APP_BASE_PATH . '/common/config/web.php'),
    require(YII_APP_BASE_PATH . '/frontend/config/base.php'),
    require(YII_APP_BASE_PATH . '/frontend/config/web.php'),
    require(__DIR__ . '/../base.php'),
    require(__DIR__ . '/../common/acceptance.php'),
    [
    ]
);
