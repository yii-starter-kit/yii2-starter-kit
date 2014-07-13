<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/9/14
 * Time: 10:05 PM
 */

namespace app\components\widgets\aceeditor;


use app\components\widgets\aceeditor\AceEditorAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class Widget extends InputWidget{
    public $mode = 'html';
    public $theme = 'github';
    public $containerOptions = [];

    public function init(){
        parent::init();
        AceEditorAsset::register($this->getView());
        $editor_id = $this->getId();
        $editor_var = 'aceeditor_'.$editor_id;
        $this->getView()->registerJs("var {$editor_var} = ace.edit(\"{$editor_id}\")");
        $this->getView()->registerJs("{$editor_var}.setTheme(\"ace/theme/{$this->theme}\")");
        $this->getView()->registerJs("{$editor_var}.getSession().setMode(\"ace/mode/{$this->mode}\")");

        $textarea_var = 'acetextarea_'.$editor_id;
        $this->getView()->registerJs("
            var {$textarea_var} = $('#{$this->options['id']}').hide();
            {$editor_var}.getSession().setValue({$textarea_var}.val());
            {$editor_var}.getSession().on('change', function(){
                {$textarea_var}.val({$editor_var}.getSession().getValue());
            });
        ");
        Html::addCssStyle($this->containerOptions, 'width: 100%; min-height: 400px');
        Html::addCssStyle($this->options, 'display: none');
        $this->containerOptions['id'] = $editor_id;
        $this->getView()->registerCss("#{$editor_id}{position:relative}");
    }

    public function run(){
        $content = Html::tag('div', '', $this->containerOptions);
        if ($this->hasModel()) {
            $content .= Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            $content .= Html::textarea($this->name, $this->value, $this->options);
        }
        return $content;
    }
}