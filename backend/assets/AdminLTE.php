<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/2/14
 * Time: 11:40 AM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class AdminLTE extends AssetBundle{
    public $sourcePath = '@backend/assets/admin-lte';
    public $css = [
        'css/AdminLTE.css'
    ];
    public $depends = [
        '\yii\web\JqueryAsset',
        '\yii\bootstrap\BootstrapPluginAsset',
        'common\assets\FontAwesome',
        'common\assets\Ionicons',
    ];
}