<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:24 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class FontAwesome extends AssetBundle{
    public $basePath = '@webroot/vendor/font-awesome';
    public $baseUrl = '@web/vendor/font-awesome';
    public $css = [
        'css/font-awesome.min.css'
    ];

} 