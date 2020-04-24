<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/2/14
 * Time: 11:40 AM
 */

namespace common\assets;

use rmrevin\yii\fontawesome\NpmFreeAssetBundle;
use common\assets\JquerySlimScroll;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class AdminLte extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
    /**
     * @var array
     */
    public $js = [
        'js/adminlte.min.js'
    ];
    /**
     * @var array
     */
    public $css = [
        '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic',
        'css/adminlte.min.css',
    ];
    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
        BootstrapPluginAsset::class,
        NpmFreeAssetBundle::class,
        JquerySlimScroll::class
    ];
}
