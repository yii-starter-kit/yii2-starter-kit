<?php

namespace common\widgets;

use Yii;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

/**
 * ActionColumn for Bootstrap4 with FontAwesome.
 *
 * @author Victor Gonzalez <victor@vgr.cl>
 */
class ActionColumn extends \yii\grid\ActionColumn
{
    public function init()
    {
        // do not call parent is then the glyphicons button would be added
        $this->initBs4Icons('view', 'search-plus');
        $this->initBs4Icons('update', 'edit');
        $this->initBs4Icons('delete', 'trash', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    protected function initBs4Icons($name, $iconName, $options = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $options) {
                $title = Yii::t('yii', ucfirst($name));
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $options, $this->buttonOptions);
                $icon = FAS::icon($iconName, ['aria' => ['hidden' => true]]);
                return Html::a($icon, $url, $options);
            };
        }
    }
}