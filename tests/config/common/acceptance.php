<?php
/**
 * Application configuration shared by all applications acceptance tests
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../base.php'),
    [
        'homeUrl' => null,
    ]
);
