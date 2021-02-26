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
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        // do not call parent is then the glyphicons button would be added
        $this->initDefaultButtons();
    }

    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'eye');
        $this->initDefaultButton('update', 'edit');
        $this->initDefaultButton('delete', 'trash', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    /**
     * Initializes the default button rendering callback for single button.
     * @param string $name Button name as it's written in template
     * @param string $iconName The part of Font Awesome icon class that makes it unique
     * @param array $additionalOptions Array of additional options
     */
    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                $defaultOptions = [];
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        $defaultOptions = [
                            'class' => ['btn', 'btn-info', 'btn-xs'],
                        ];
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        $defaultOptions = [
                            'class' => ['btn', 'btn-warning', 'btn-xs'],
                        ];
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        $defaultOptions = [
                            'class' => ['btn', 'btn-danger', 'btn-xs'],
                        ];
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions, $defaultOptions);
                $icon = FAS::icon($iconName, ['aria' => ['hidden' => true], 'class' => ['fa-fw']]);
                return Html::a($icon, $url, $options);
            };
        }
    }
}
