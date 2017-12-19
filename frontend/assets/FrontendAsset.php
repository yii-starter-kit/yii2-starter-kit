<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use common\assets\Html5shiv;
use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Frontend application asset
 */
class FrontendAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    /**
     * @var string
     */
    public $baseUrl = '@web';

    /**
     * @var array
     */
    public $css = [
        'bundle/style.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'bundle/app.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        Html5shiv::class,
    ];
}
