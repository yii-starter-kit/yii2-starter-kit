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
    public $basePath = '@webroot';
    public $baseUrl = '@backendUrl';

    public $css = [
        'css/style.less'
    ];
    public $js = [
        'js/app.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'common\assets\AdminLTE',
        'common\assets\Html5shiv',
    ];
} 
