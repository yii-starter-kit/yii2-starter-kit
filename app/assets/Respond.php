<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 8:16 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class Respond extends AssetBundle{
    public $basePath = '@webroot/vendor/respond';
    public $baseUrl = '@web/vendor/respond';
    public $js = [
        'src/respond.js'
    ];

    public $jsOptions = [
        'condition'=>'lt IE 9'
    ];
} 