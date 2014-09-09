<?php
return \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/_base.php'),
    [
        'homeUrl'=>Yii::getAlias('@backendUrl'),
    ]
);