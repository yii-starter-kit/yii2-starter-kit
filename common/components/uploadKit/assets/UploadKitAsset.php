<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 */

namespace common\components\uploadKit\assets;

use yii\web\AssetBundle;

class UploadKitAsset extends AssetBundle{
    public function init(){
        $this->sourcePath = __DIR__ . '/upload-kit';
        parent::init();
    }

    public $css = [
        'css/upload-kit.css'
    ];

    public $js = [
        'js/upload-kit.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'common\assets\FontAwesome',
        'common\components\uploadKit\assets\BlueimpAsset',
    ];
} 