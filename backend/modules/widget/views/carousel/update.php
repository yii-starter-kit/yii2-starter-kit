<?php

use common\grid\EnumColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var $this                  yii\web\View
 * @var $model                 common\models\WidgetCarousel
 * @var $carouselItemsProvider yii\data\ArrayDataProvider
 */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Widget Carousel',
    ]) . ' ' . $model->key;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php echo $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>

<p>
    <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
        'modelClass' => 'Widget Carousel Item',
    ]), ['carousel-item/create', 'carousel_id' => $model->id], ['class' => 'btn btn-success']) ?>
</p>

<?php echo GridView::widget([
    'dataProvider' => $carouselItemsProvider,
    'options' => [
        'class' => 'grid-view table-responsive',
    ],
    'columns' => [
        [
            'attribute' => 'order',
            'options' => ['style' => 'width: 5%'],
        ],
        'path',
        'url:url',
        [
            'attribute' => 'caption',
            'options' => ['style' => 'width: 20%'],
            'format' => 'html',
        ],
        [
            'class' => EnumColumn::class,
            'attribute' => 'status',
            'options' => ['style' => 'width: 10%'],
            'enum' => [
                Yii::t('backend', 'Disabled'),
                Yii::t('backend', 'Enabled'),
            ],
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'options' => ['style' => 'width: 5%'],
            'controller' => '/widget/carousel-item',
            'template' => '{update} {delete}',
        ],
    ],
]); ?>
