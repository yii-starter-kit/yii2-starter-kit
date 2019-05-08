<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:24 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class FontAwesome extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@npm/font-awesome';
    /**
     * @var array
     */
    public $css = [
        'css/font-awesome.min.css'
    ];
}
