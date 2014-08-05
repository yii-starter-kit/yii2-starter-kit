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
        'css/backend.css'
    ];
    public $js = [
        'js/app.js'
    ];


    public $depends = [
        'backend\assets\AdminLTE',
        'common\assets\Respond',
        'common\assets\Html5shiv',
    ];
} 