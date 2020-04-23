<?php

use kartik\date\DatePicker;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FAR;
use yii\helpers\Html;

/**
 * @var $this         yii\web\View
 * @var $searchModel  \backend\modules\file\models\search\FileStorageItemSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $components   array
 * @var $totalSize    integer
 */

$this->title = Yii::t('backend', 'File Storage Items');

$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-sm-3">
        <div class="info-box">
            <span class="info-box-icon bg-success"><?php echo FAR::icon('copy') ?></span>

            <div class="info-box-content">
                <span class="info-box-text"><?php echo Yii::t('backend', 'Uploads') ?></span>
                <span class="info-box-number"><?php echo $dataProvider->totalCount ?></span>
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><?php echo FAR::icon('hdd') ?></span>

            <div class="info-box-content">
                <span class="info-box-text"><?php echo Yii::t('backend', 'Used size') ?></span>
                <span class="info-box-number"><?php echo Yii::$app->formatter->asShortSize($totalSize, 2) ?></span>
            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body p-0">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'table-striped', 'table-bordered', 'mb-0', 'table-sm'],
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'component',
                    'filter' => $components,
                ],
                'path',
                'type',
                'size:size',
                'name',
                'upload_ip',
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
