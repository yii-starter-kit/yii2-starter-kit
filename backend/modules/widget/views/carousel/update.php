<?php

use common\grid\EnumColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var common\models\WidgetCarousel $model
 * @var yii\data\ArrayDataProvider $carouselItemsProvider
 */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Widget Carousel',
    ]) . ' ' . $model->key;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<?php echo $this->render('_form', [
    'model' => $model,
]) ?>

<div class="card">
    <div class="card-header">
        <?php echo Html::a(FAS::icon('plus').' '.Yii::t('backend', 'Create {modelClass}', [
            'modelClass' => 'Widget Carousel Item',
        ]), ['carousel-item/create', 'carousel_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="card-body p-0">
        <?php echo GridView::widget([
            'dataProvider' => $carouselItemsProvider,
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
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
                    'class' => \common\widgets\ActionColumn::class,
                    'options' => ['style' => 'width: 5%'],
                    'controller' => '/widget/carousel-item',
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
    <div class="card-footer">
        <?php echo getDataProviderSummary($carouselItemsProvider) ?>
    </div>
</div>