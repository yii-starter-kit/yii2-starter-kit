<?php

use common\grid\EnumColumn;
use common\models\User;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var backend\models\search\UserSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header">
        <?php echo Html::a(FAS::icon('user-plus').' '.Yii::t('backend', 'Add New {modelClass}', [
            'modelClass' => 'User',
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="card-body p-0">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
            ],
            'columns' => [
                [
                    'attribute' => 'id',
                    'options' => ['style' => 'width: 5%'],
                ],
                'username',
                'email:email',
                [
                    'class' => EnumColumn::class,
                    'attribute' => 'status',
                    'enum' => User::statuses(),
                    'filter' => User::statuses()
                ],
                [
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'pluginOptions' => [
                            'format' => 'dd-mm-yyyy',
                            'showMeridian' => true,
                            'todayBtn' => true,
                            'endDate' => '0d',
                        ]
                    ]),
                ],
                [
                    'attribute' => 'logged_at',
                    'format' => 'datetime',
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'logged_at',
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'pluginOptions' => [
                            'format' => 'dd-mm-yyyy',
                            'showMeridian' => true,
                            'todayBtn' => true,
                            'endDate' => '0d',
                        ]
                    ]),
                ],
                // 'updated_at',

                [
                    'class' => \common\widgets\ActionColumn::class,
                    'template' => '{login} {view} {update} {delete}',
                    'options' => ['style' => 'width: 140px'],
                    'buttons' => [
                        'login' => function ($url) {
                            return Html::a(
                                FAS::icon('sign-in-alt', ['aria' => ['hidden' => true], 'class' => ['fa-fw']]),
                                $url,
                                [
                                    'title' => Yii::t('backend', 'Login'),
                                    'class' => ['btn', 'btn-xs', 'btn-secondary']
                                ]
                            );
                        },
                    ],
                    'visibleButtons' => [
                        'login' => Yii::$app->user->can('administrator')
                    ]

                ],
            ],
        ]); ?>
    </div>

    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>
