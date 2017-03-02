<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FileStorageItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $components array */
/* @var $totalSize integer */

$this->title = Yii::t('backend', 'File Storage Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-storage-item-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row text-right">
        <div class="pull-right">
            <div class="col-xs-12">
                <dl>
                    <dt>
                        <?php echo Yii::t('backend', 'Used size') ?>:
                    </dt>
                    <dd>
                        <?php echo Yii::$app->formatter->asSize($totalSize); ?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="pull-right">
            <div class="row">
                <div class="col-xs-12">
                    <dl>
                        <dt>
                            <?php echo Yii::t('backend', 'Count') ?>:
                        </dt>
                        <dd>
                            <?php echo $dataProvider->totalCount ?>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'component',
                'filter' => $components
            ],
            'path',
            'type',
            'size:size',
            'name',
            'upload_ip',
            'created_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}'
            ]
        ]
    ]); ?>

</div>
