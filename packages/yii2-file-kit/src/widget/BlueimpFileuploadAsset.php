<?php
namespace trntv\filekit\widget;

use yii\web\AssetBundle;

class BlueimpFileuploadAsset extends AssetBundle
{
    public $sourcePath = '@npm/blueimp-file-upload';

    public $css = [
        'css/jquery.fileupload.css'
    ];

    public $js = [
        'js/vendor/jquery.ui.widget.js',
        'js/jquery.iframe-transport.js',
        'js/jquery.fileupload.js',
        'js/jquery.fileupload-process.js',
        'js/jquery.fileupload-image.js',
        'js/jquery.fileupload-validate.js'
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
        \trntv\filekit\widget\BlueimpLoadImageAsset::class
    ];
}
