<?php

return \yii\helpers\ArrayHelper::merge(
    require(__DIR__.'/_base.php'),
    [
        // 'po' output format is for saving messages to gettext po files.
        'format' => 'po',
        // Root directory containing message translations.
        'messagePath' => Yii::getAlias('@common/messages'),
        // Name of the file that will be used for translations.
        'catalog' => 'messages',
        // boolean, whether the message file should be overwritten with the merged messages
        'overwrite' => true,
    ]
);
