<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:24 PM
 */

namespace common\assets;


use yii\web\AssetBundle;

class Ionicons extends AssetBundle{
    public $sourcePath = '@common/assets/bower/ionicons';
    public $css = [
        'css/ionicons.min.css'
    ];

} 