<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/5/14
 * Time: 11:16 AM
 */

namespace app\components\widgets\menu;


use app\models\WidgetMenu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Widget extends \yii\widgets\Menu{

    public $linkTemplate = "<a href=\"{url}\">\n{icon}\n{label}\n{badge}</a>";
    public $labelTemplate = '{icon}\n{label}\n{badge}';

    public $badgeTag = 'small';
    public $badgeClass = 'badge pull-right';
    public $badgeBgClass = 'bg-green';

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        $item['badgeOptions'] = isset($item['badgeOptions']) ? $item['badgeOptions'] : [];

        if(!ArrayHelper::getValue($item, 'badgeOptions.class')){
            $bg = isset($item['badgeBgClass']) ? $item['badgeBgClass'] : $this->badgeBgClass;
            $item['badgeOptions']['class'] = $this->badgeClass.' '.$bg;
        }


        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{badge}'=> isset($item['badge'])
                    ? Html::tag('small', $item['badge'], $item['badgeOptions'])
                    : '',
                '{icon}'=>isset($item['icon']) ? $item['icon'] : '',
                '{url}' => Url::to($item['url']),
                '{label}' => $item['label'],
            ]);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{badge}'=> isset($item['badge'])
                    ? Html::tag('small', $item['badge'], $item['badgeOptions'])
                    : '',
                '{icon}'=>isset($item['icon']) ? $item['icon'] : '',
                '{label}' => $item['label'],
            ]);
        }
    }

}