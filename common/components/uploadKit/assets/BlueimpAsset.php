<?php
namespace common\components\uploadKit\assets;

use yii\web\AssetBundle;

class BlueimpAsset extends AssetBundle
{
    public function init(){
        $this->sourcePath = __DIR__ . '/blueimp';
        parent::init();
    }

    public $css = [
        'blueimp-file-upload/css/jquery.fileupload.css'
    ];

    public $js = [
        'blueimp-file-upload/js/vendor/jquery.ui.widget.js',
        'blueimp-file-upload/js/jquery.iframe-transport.js',
        'blueimp-file-upload/js/jquery.fileupload.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
} 