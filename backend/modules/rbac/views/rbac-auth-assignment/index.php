<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\grid\EnumColumn;
use common\models\User;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header">
        <?php echo Html::a(FAS::icon('user-plus').' '.Yii::t('backend', 'Add New {modelClass}', [
            'modelClass' => 'Assignment',
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

                'item_name',
                [
                    'class' => EnumColumn::class,
                    'attribute' => 'user_id',
                    'label' => Yii::t('backend', 'User'),
                    'enum' => ArrayHelper::map(User::find()->all(), 'id', 'publicIdentity'),
                ],
                'created_at:datetime',

                ['class' => \common\widgets\ActionColumn::class],
            ],
        ]); ?>

    </div>

    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>



