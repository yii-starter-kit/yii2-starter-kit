<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/9/14
 * Time: 10:01 PM
 */

namespace app\components\widgets\aceeditor;


use yii\web\AssetBundle;

class AceEditorAsset extends AssetBundle{
    public function init(){
        $this->sourcePath = __DIR__.'/assets/ace-builds/src-noconflict';
        parent::init();
    }

    public $js = [
        'ace.js'
    ];

} 