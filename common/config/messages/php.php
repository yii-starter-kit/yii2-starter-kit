<?php

return \yii\helpers\ArrayHelper::merge(
    require(__DIR__.'/_base.php'),
    [
        // 'php' output format is for saving messages to php files.
        'format' => 'php',
        // Root directory containing message translations.
        'messagePath' => Yii::getAlias('@common/messages'),
        // boolean, whether the message file should be overwritten with the merged messages
        'overwrite' => true,
    ]
);
