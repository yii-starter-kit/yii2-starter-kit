<?php

return \yii\helpers\ArrayHelper::merge(
    require(dirname(__DIR__).'/../../app/config/console.php'),
    require('_base.php'),
    []
);
