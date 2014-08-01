<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class BackendAsset extends AssetBundle{
    public $sourcePath = '@backend/assets/static';

    public $css = [
        'css/style.css'
    ];
    public $js = [
        'js/app.js'
    ];


    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'common\assets\FontAwesome',
        'common\assets\Ionicons',
        'common\assets\Respond',
        'common\assets\Html5shiv',
    ];
} 