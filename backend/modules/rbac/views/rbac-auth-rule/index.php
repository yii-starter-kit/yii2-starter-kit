<?php

use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header">
        <?php echo Html::a(FAS::icon('user-plus').' '.Yii::t('backend', 'Add New {modelClass}', [
            'modelClass' => 'Rule',
        ]), ['create'], ['class' => 'btn btn-success']) ?>
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

                'name',
                'data',
                'created_at:datetime',
                'updated_at:datetime',

                ['class' => \common\widgets\ActionColumn::class],
            ],
        ]); ?>
    </div>

    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>



