<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:24 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class Ionicons extends AssetBundle{
    public $basePath = '@webroot/vendor/ionicons';
    public $baseUrl = '@web/vendor/ionicons';
    public $css = [
        'css/ionicons.min.css'
    ];

} 