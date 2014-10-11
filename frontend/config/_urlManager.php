<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        'pattern'=>'page/<alias>', 'route'=>'page/view'
    ]
];