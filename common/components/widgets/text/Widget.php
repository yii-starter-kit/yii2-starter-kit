<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 6/23/14
 * Time: 10:30 AM
 */

namespace common\components\widgets\text;

use common\models\WidgetText;

class Widget extends \yii\base\Widget{
    public $alias;
    public function run(){
        $block =  WidgetText::findOne(['alias'=>$this->alias]);
        echo $block ? $block->body : '';
    }
} 