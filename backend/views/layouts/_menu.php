<?php
use backend\widgets\Menu;
use common\components\interfaces\PlugModule;
use common\models\TimelineEvent;
use yii\helpers\ArrayHelper;


$main = [
  [
    'label' => Yii::t('backend', 'Main'),
    'options' => ['class' => 'header'],
  ],
  [
    'label' => Yii::t('backend', 'Timeline'),
    'icon' => '<i class="fa fa-bar-chart-o"></i>',
    'url' => ['/timeline-event/index'],
    'badge' => TimelineEvent::find()->today()->count(),
    'badgeBgClass' => 'label-success',
    'visible' => Yii::$app->user->can('/timeline-event/*'),
  ],
  [
    'label' => Yii::t('backend', 'Content'),
    'url' => '#',
    'icon' => '<i class="fa fa-edit"></i>',
    'options' => ['class' => 'treeview'],
    'items' => [
      [
        'label' => Yii::t('backend', 'Static pages'),
        'url' => ['/page/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/page/*'),
      ],
      [
        'label' => Yii::t('backend', 'Articles'),
        'url' => ['/article/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/article/*'),
      ],
      [
        'label' => Yii::t('backend', 'Article Categories'),
        'url' => ['/article-category/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/article-category/*'),
      ],
      [
        'label' => Yii::t('backend', 'Text Widgets'),
        'url' => ['/widget-text/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/widget-text/*'),
      ],
      [
        'label' => Yii::t('backend', 'Menu Widgets'),
        'url' => ['/widget-menu/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/widget-menu/*'),
      ],
      [
        'label' => Yii::t('backend', 'Carousel Widgets'),
        'url' => ['/widget-carousel/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/widget-carousel/*'),
      ],
    ],
  ],
];

$modules = [
  [
    'label' => Yii::t('backend', 'Modules'),
    'options' => ['class' => 'header'],
  ],
];
foreach (Yii::$app->getModules() as $key => $value) {
  $module = Yii::$app->getModule($key);
  if ($module instanceof PlugModule) {
    $menu_data = $module->getMenu();
    foreach ($menu_data as $i) {
      $modules[] = $i;
    }
  }
}

$system = [
  [
    'label' => Yii::t('backend', 'System'),
    'options' => ['class' => 'header'],
  ],
  [
    'label' => Yii::t('backend', 'Users'),
    'icon' => '<i class="fa fa-users"></i>',
    'url' => ['/user/index'],
    'visible' => Yii::$app->user->can('administrator'),
  ],
  [
    'label' => Yii::t('backend', 'Roles'),
    'icon' => '<i class="fa fa-lock"></i>',
    'url' => ['/admin/role'],
    'visible' => Yii::$app->user->can('/admin/*'),
  ],
  [
    'label' => Yii::t('backend', 'Other'),
    'url' => '#',
    'icon' => '<i class="fa fa-cogs"></i>',
    'options' => ['class' => 'treeview'],
    'items' => [
      [
        'label' => Yii::t('backend', 'i18n'),
        'url' => '#',
        'icon' => '<i class="fa fa-flag"></i>',
        'options' => ['class' => 'treeview'],
        'items' => [
          [
            'label' => Yii::t('backend', 'i18n Source Message'),
            'url' => ['/i18n/i18n-source-message/index'],
            'icon' => '<i class="fa fa-angle-double-right"></i>',
          ],
          [
            'label' => Yii::t('backend', 'i18n Message'),
            'url' => ['/i18n/i18n-message/index'],
            'icon' => '<i class="fa fa-angle-double-right"></i>',
          ],
        ],
        'visible' => Yii::$app->user->can('/i18n/*'),
      ],
      [
        'label' => Yii::t('backend', 'Key-Value Storage'),
        'url' => ['/key-storage/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/key-storage/*'),
      ],
      [
        'label' => Yii::t('backend', 'File Storage'),
        'url' => ['/file-storage/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/file-storage/*'),
      ],
      [
        'label' => Yii::t('backend', 'Cache'),
        'url' => ['/cache/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/cache/*'),
      ],
      [
        'label' => Yii::t('backend', 'File Manager'),
        'url' => ['/file-manager/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/file-manager/*'),
      ],
      [
        'label' => Yii::t('backend', 'System Information'),
        'url' => ['/system-information/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'visible' => Yii::$app->user->can('/system-information/*'),
      ],
      [
        'label' => Yii::t('backend', 'Logs'),
        'url' => ['/log/index'],
        'icon' => '<i class="fa fa-angle-double-right"></i>',
        'badge' => \backend\models\SystemLog::find()->count(),
        'badgeBgClass' => 'label-danger',
        'visible' => Yii::$app->user->can('/log/*'),
      ],
    ],
  ],
];
$menu_items = ArrayHelper::merge($main, $modules, $system);
echo Menu::widget([
                    'options' => ['class' => 'sidebar-menu'],
                    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                    'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                    'activateParents' => true,
                    'items' => $menu_items,
                  ]);
