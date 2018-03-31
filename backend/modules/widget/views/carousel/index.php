<?php

use common\grid\EnumColumn;
use common\models\WidgetCarousel;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var $this                  yii\web\View
 * @var $searchModel           \backend\modules\widget\models\search\CarouselSearch
 * @var $dataProvider          yii\data\ActiveDataProvider
 * @var $model                 common\models\WidgetCarousel
 */

$this->title = Yii::t('backend', 'Widget Carousels');

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box box-success collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title"><?php echo Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'Widget Carousel']) ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <?php echo $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>

<?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => [
        'class' => 'grid-view table-responsive',
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
            'class' => 'yii\grid\ActionColumn',
            'options' => ['style' => 'width: 5%'],
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
