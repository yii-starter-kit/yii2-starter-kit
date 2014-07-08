<?php
return \yii\helpers\ArrayHelper::merge(
    require(dirname(__DIR__).'/../../app/config/web.php'),
    require('common.php'),
    [
        'components'=>[
            'db'=>require('db.php')
        ]
    ]
);