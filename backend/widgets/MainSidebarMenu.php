<?php

namespace backend\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Menu displays a multi-level sidebar menu according to AdminLTE 3 design.
 *
 * The main property of Menu is [[items]], which specifies the possible items in the menu.
 * A menu item can contain sub-items which specify the sub-menu under that menu item.
 *
 * Menu checks the current route and request parameters to toggle certain menu items
 * with active state.
 *
 * The rendered HTML complies with the AdminLTE 3 design for the main sidebar component.
 * See [AdminLTE 3 Docs](https://adminlte.io/docs/3.0/components/main-sidebar.html).
 *
 * @package backend\components\widgets
 * @author Eugine Terentev <eugine@terentev.net>
 * @author Victor Gonzalez <victor@vgr.cl>
 */
class MainSidebarMenu extends \yii\widgets\Menu
{
    /**
     * @var string the template used to render the body of a menu which is a link.
     *
     * In this template, the token `{url}` will be replaced with the corresponding link URL;
     * while `{label}` will be replaced with the link text.
     *
     * Additionally, to comply with AdminLTE 3 design, the following tags were added:
     *
     *  - `{icon}`: an icon shown before a label.
     *  - `{dropdown-caret}`: the dropdown caret icon.
     *  - `{badge}`: a badge shown between the label and the `{dropdown-caret}`.
     *
     * This property will be overridden by the `template` option set in individual menu items via [[items]].
     */
    public $linkTemplate = '<a href="{url}" class="nav-link">{icon}&nbsp;<p>{label}{dropdown-caret}{badge}</p></a>';

    /**
     * @var string the template used to render the body of a menu which is a link.
     *
     * In this template, the token `{url}` will be replaced with the corresponding link URL;
     * while `{label}` will be replaced with the link text.
     *
     * Additionally, to comply with AdminLTE 3 design, the following tags were added:
     *
     *  - `{icon}`: replaced with an icon shown before a label.
     *  - `{dropdown-caret}`: replaced with the dropdown caret icon.
     *  - `{badge}`: a badge shown between the label and the `{dropdown-caret}`.
     *
     * This property will be overridden by the `template` option set in individual menu items via [[items]],
     * but this template should not be changed to preserve AdminLte 3 compatibility.
     */
    public $linkTemplateActive = '<a href="{url}" class="nav-link active">{icon}&nbsp;<p>{label}{dropdown-caret}{badge}</p></a>';

    /**
     * @var string the template used to render the body of a menu which is NOT a link.
     * In this template, the token `{label}` will be replaced with the label of the menu item,
     * while `{icon}` will be repplaced by an icon image
     * This property will be overridden by the `template` option set in individual menu items via [[items]].
     */
    public $labelTemplate = "{icon}\n{label}\n{badge}";

    /**
     * @var string the template used to render a list of sub-menus.
     * In this template, the token `{items}` will be replaced with the rendered sub-menu items.
     */
    public $submenuTemplate = '<ul class="nav nav-treeview">{items}</ul>';

    /**
     * @var string the badge element HTML tag.
     */
    public $badgeTag = 'span';

    /**
     * @var string the badge element base CSS classes.
     */
    public $badgeClass = 'badge right';

    /**
     * @var string the badge element background CSS class.
     */
    public $badgeBgClass;

    /**
     * @var string the dropdown caret icon.
     * @see $linkTemplate, $linkTemplateActive
     */
    public $dropdownCaret = '<i class="fas fa-angle-left right"></i>';

    /**
     * @var array array list of the HTML attributes for the menu's container tag..
     */
    public $options;

    /**
     * @var array list of HTML attributes shared by all menu [[items]]. If any individual menu item
     * specifies its `options`, it will be merged with this property before being used to generate the HTML
     * attributes for the menu item tag. The following special options are recognized:
     *
     * - tag: string, defaults to "li", the tag name of the item container tags.
     *   Set to false to disable container tag.
     *   See also [[\yii\helpers\Html::tag()]].
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $itemOptions = ['class' => ['nav-item']];

    /**
     * @var bool whether to activate parent menu items when one of the corresponding child menu items is active.
     * The activated parent menu items will also have its CSS classes appended with [[activeCssClass]].
     */
    public $activateParents = true;

    /**
     * @var string the CSS class to be appended to the active menu item.
     */
    public $activeCssClass = 'menu-open';

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        // check if item is active and set special template
        $linkTemplate = $this->linkTemplate;
        if ($item['active']) {
            $linkTemplate = $this->linkTemplateActive;
        }

        // set badge if any
        $item['badgeOptions'] = isset($item['badgeOptions']) ? $item['badgeOptions'] : [];
        if (!ArrayHelper::getValue($item, 'badgeOptions.class')) {
            $bg = isset($item['badgeBgClass']) ? $item['badgeBgClass'] : $this->badgeBgClass;
            $item['badgeOptions']['class'] = $this->badgeClass . ' ' . $bg;
        }

        // add dropdown caret if item has childrens
        if (isset($item['items']) && !isset($item['dropdown-caret'])) {
            $item['dropdown-caret'] = $this->dropdownCaret;
        }

        if (isset($item['url'])) {
            // item uses an url, so uses the `$linkTemplate` variable
            $template = ArrayHelper::getValue($item, 'template', $linkTemplate);

            return strtr($template, [
                '{badge}' => isset($item['badge']) ? Html::tag('span', $item['badge'], $item['badgeOptions']) : '',
                '{icon}' => isset($item['icon']) ? $item['icon'] : '',
                '{dropdown-caret}' => isset($item['dropdown-caret']) ? $item['dropdown-caret'] : '',
                '{url}' => Url::to($item['url']),
                '{label}' => $item['label'],
            ]);
        } else {
            // just a plain text item
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{badge}' => isset($item['badge'])
                    ? Html::tag('small', $item['badge'], $item['badgeOptions'])
                    : '',
                '{icon}' => isset($item['icon']) ? $item['icon'] : '',
                '{dropdown-caret}' => isset($item['dropdown-caret']) ? $item['dropdown-caret'] : '',
                '{label}' => $item['label'],
            ]);
        }
    }
}
