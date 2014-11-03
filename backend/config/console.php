<?php
$config = \yii\helpers\ArrayHelper::merge(
    require(__DIR__.'/_base.php'),
    []
);

return $config;
