<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets;

use common\assets\AdminLte;
use common\assets\Html5shiv;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class BackendAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@backend/web/bundle';

    /**
     * @var array
     */
    public $css = [
        'style.css'
    ];
    /**
     * @var array
     */
    public $js = [
        'app.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        AdminLte::class,
        Html5shiv::class
    ];
}
