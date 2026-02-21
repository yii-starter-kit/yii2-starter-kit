<?php
namespace trntv\filekit\widget;

use yii\web\AssetBundle;

class BlueimpCanvasToBlobAsset extends AssetBundle
{
    public $sourcePath = '@npm/blueimp-canvas-to-blob';

    public $js = [
        'js/canvas-to-blob.min.js'
    ];
}
