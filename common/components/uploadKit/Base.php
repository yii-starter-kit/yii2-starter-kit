<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/6/14
 * Time: 12:06 AM
 */

namespace common\components\widgets\blueimp;

use yii\helpers\Url;
use yii\widgets\InputWidget;

class Base extends InputWidget{

    public $url;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if(!$this->options['data-url']) {
            $this->options['data-url'] = Url::to($this->url);
        }
    }
} 