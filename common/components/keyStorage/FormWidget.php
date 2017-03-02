<?php

namespace common\components\keyStorage;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class FormWidget extends Widget
{
    /**
     * @var \common\components\keyStorage\FormModel
     */
    public $model;
    /**
     * @var string
     */
    public $formClass = '\yii\widgets\ActiveForm';
    /**
     * @var array
     */
    public $formOptions;
    /**
     * @var string
     */
    public $submitText;
    /**
     * @var array
     */
    public $submitOptions;

    /**
     * @throws InvalidConfigException
     */
    public function run()
    {
        $model = $this->model;
        $form = call_user_func([$this->formClass, 'begin'], $this->formOptions);
        foreach ($model->keys as $key => $config) {
            $type = ArrayHelper::getValue($config, 'type', FormModel::TYPE_TEXTINPUT);
            $options = ArrayHelper::getValue($config, 'options', []);
            $field = $form->field($model, $key);
            $items = ArrayHelper::getValue($config, 'items', []);
            switch ($type) {
                case FormModel::TYPE_TEXTINPUT:
                    $input = $field->textInput($options);
                    break;
                case FormModel::TYPE_DROPDOWN:
                    $input = $field->dropDownList($items, $options);
                    break;
                case FormModel::TYPE_CHECKBOX:
                    $input = $field->checkbox($options);
                    break;
                case FormModel::TYPE_CHECKBOXLIST:
                    $input = $field->checkboxList($items, $options);
                    break;
                case FormModel::TYPE_RADIOLIST:
                    $input = $field->radioList($items, $options);
                    break;
                case FormModel::TYPE_TEXTAREA:
                    $input = $field->textarea($options);
                    break;
                case FormModel::TYPE_WIDGET:
                    $widget = ArrayHelper::getValue($config, 'widget');
                    if ($widget === null) {
                        throw new InvalidConfigException('Widget class must be set');
                    }
                    $input = $field->widget($widget, $options);
                    break;
                default:
                    $input = $field->input($type, $options);

            }
            echo $input;
        }
        echo Html::submitButton($this->submitText, $this->submitOptions);
        call_user_func([$this->formClass, 'end']);
    }
}
