<?php

namespace common\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class Flot extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@npm/flot/dist/es5';
    /**
     * @var array
     */
    public $js = [
        'jquery.flot.js'
    ];
    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class
    ];
}
