<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace app\modules\manager\assets;


use yii\web\AssetBundle;

class ManagerAsset extends AssetBundle{
    public $sourcePath = '@app/modules/manager/assets/static';

    public $css = [
        'css/style.css'
    ];
    public $js = [
        'js/app.js'
    ];


    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'app\assets\FontAwesome',
        'app\assets\Ionicons',
        'app\assets\Respond',
        'app\assets\Html5shiv',
    ];
} 