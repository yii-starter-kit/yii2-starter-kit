<?php

return \yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/_base.php',
    [
        // 'db' output format is for saving messages to database.
        'format' => 'db',
        // Connection component to use. Optional.
        'db' => 'db',
        // Custom source message table. Optional.
        'sourceMessageTable' => '{{%i18n_source_message}}',
        // Custom name for translation message table. Optional.
        'messageTable' => '{{%i18n_message}}',
    ]
);
