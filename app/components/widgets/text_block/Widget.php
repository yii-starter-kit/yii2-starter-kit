<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 6/23/14
 * Time: 10:30 AM
 */

namespace app\components\widgets\text_block;


use app\models\TextBlock;

class Widget extends \yii\base\Widget{
    public $alias;
    public function run(){
        $block =  TextBlock::findOne(['alias'=>$this->alias]);
        echo $block ? $block->text : '';
    }
} 