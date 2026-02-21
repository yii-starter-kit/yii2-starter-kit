<?php
namespace trntv\filekit\widget;

use yii\web\AssetBundle;

class BlueimpTmplAsset extends AssetBundle
{
    public $sourcePath = '@npm/blueimp-tmpl';

    public $js = [
        'js/tmpl.min.js'
    ];
}
