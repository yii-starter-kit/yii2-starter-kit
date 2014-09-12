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
    public $sourcePath = '@common/assets/bower/admin-lte';
    public $js = [
        'js/AdminLTE/app.js'
    ];
    public $css = [
        'css/AdminLTE.css'
    ];
    public $depends = [
        '\yii\web\JqueryAsset',
        '\yii\jui\SortableAsset',
        '\yii\bootstrap\BootstrapPluginAsset',
        'common\assets\FontAwesome',
        'common\assets\Ionicons',
    ];
}