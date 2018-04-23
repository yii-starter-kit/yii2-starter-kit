<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        // Pages
        ['pattern' => 'page/<slug>', 'route' => 'page/view'],

        // Articles
        ['pattern' => 'article/index', 'route' => 'article/index'],
        ['pattern' => 'article/attachment-download', 'route' => 'article/attachment-download'],
        ['pattern' => 'article/<slug>', 'route' => 'article/view'],
    ]
];
