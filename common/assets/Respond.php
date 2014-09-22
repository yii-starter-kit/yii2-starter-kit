<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 8:16 PM
 */

namespace common\assets;


use yii\web\AssetBundle;

class Respond extends AssetBundle{
    public $sourcePath = '@common/assets/bower/respond';
    public $js = [
        'src/respond.js'
    ];
    public $jsOptions = [
        'condition'=>'lt IE 9'
    ];
} 