<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 4:38 PM
 */

namespace common\components\widgets\datetimepicker;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * Class DatetimepickerWidget
 * @package common\components\widgets\datetimepicker
 */
class DatetimepickerWidget extends InputWidget{
    /**
     * @var array
     */
    public $jsOptions = [];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init(){
        parent::init();
        // Init default jsOptions
        $this->jsOptions = ArrayHelper::merge([
            'language'=>\Yii::$app->language,
            'format'=>'DD.MM.YYYY, HH:mm'
        ], $this->jsOptions);

        // Init default options
        $this->options = ArrayHelper::merge([
            'class'=>'form-control'
        ], $this->options);
        DatetimepickerAsset::register($this->getView());
        $this->getView()->registerJs('$("#'.$this->options['id'].'").datetimepicker('.json_encode($this->jsOptions).')');
    }

    /**
     * @return string
     */
    public function run(){
        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            return Html::textInput($this->name, $this->value, $this->options);
        }
    }
}