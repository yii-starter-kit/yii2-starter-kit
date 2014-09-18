<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 8:16 PM
 */

namespace common\assets;


use yii\web\AssetBundle;

class Excanvas extends AssetBundle{
    public $sourcePath = '@bower/excanvas';
    public $js = [
        'excanvas.js'
    ];

    public $jsOptions = [
        'condition'=>'lte IE 8'
    ];
} 