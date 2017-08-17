<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        ['pattern'=>'cache/<path:(.*)>/<q:(.*)>', 'route'=>'glide/index', 'encodeParams' => false]
    ]
];
