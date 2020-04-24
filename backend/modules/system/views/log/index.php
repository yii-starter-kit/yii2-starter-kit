<?php

use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var $this         yii\web\View
 * @var $searchModel  backend\modules\system\models\search\SystemLogSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('backend', 'System Logs');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header">
        <?php echo Html::a(FAS::icon('trash').' '.Yii::t('backend', 'Clear Logs'), ['clear-logs'], ['class' => 'btn btn-danger', 'data-method' => 'post' ]) ?>
    </div>

    <div class="card-body p-0">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'level',
                    'value' => function ($model) {
                        return \yii\log\Logger::getLevelName($model->level);
                    },
                    'filter' => [
                        \yii\log\Logger::LEVEL_ERROR => 'error',
                        \yii\log\Logger::LEVEL_WARNING => 'warning',
                        \yii\log\Logger::LEVEL_INFO => 'info',
                        \yii\log\Logger::LEVEL_TRACE => 'trace',
                        \yii\log\Logger::LEVEL_PROFILE_BEGIN => 'profile begin',
                        \yii\log\Logger::LEVEL_PROFILE_END => 'profile end',
                    ],
                ],
                'category',
                'prefix',
                [
                    'attribute' => 'log_time',
                    'format' => 'datetime',
                    'value' => function ($model) {
                        return (int)$model->log_time;
                    },
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'log_time',
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
                    'class' => \common\widgets\ActionColumn::class,
                    'template' => '{view} {delete}',
                ],
            ],
        ]); ?>
    </div>

    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>
