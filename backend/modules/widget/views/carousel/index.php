<?php

use common\grid\EnumColumn;
use common\models\WidgetCarousel;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \backend\modules\widget\models\search\CarouselSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\WidgetCarousel $model
 */

$this->title = Yii::t('backend', 'Widget Carousels');

$this->params['breadcrumbs'][] = $this->title;

?>

<?php echo $this->render('_form', [
    'model' => $model,
]) ?>

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
                'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
            ],
            'columns' => [
                [
                    'attribute' => 'id',
                    'options' => ['style' => 'width: 5%'],
                ],
                [
                    'attribute' => 'key',
                    'value' => function ($model) {
                        return Html::a($model->key, ['update', 'id' => $model->id]);
                    },
                    'format' => 'raw',
                ],
                [
                    'class' => EnumColumn::class,
                    'attribute' => 'status',
                    'options' => ['style' => 'width: 10%'],
                    'enum' => WidgetCarousel::statuses(),
                    'filter' => WidgetCarousel::statuses(),
                ],
                [
                    'class' => \common\widgets\ActionColumn::class,
                    'options' => ['style' => 'width: 5%'],
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>


