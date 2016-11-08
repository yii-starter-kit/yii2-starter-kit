<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetCarousel */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Widget Carousel',
]) . ' ' . $model->key;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="widget-carousel-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
            'modelClass' => 'Widget Carousel Item',
        ]), ['/widget-carousel-item/create', 'carousel_id'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $carouselItemsProvider,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'order',
            [
                'attribute' => 'path',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->path ? Html::img($model->getImageUrl(), ['style'=>'width: 100%']) : null;
                }
            ],
            'url:url',
            [
                'format' => 'html',
                'attribute' => 'caption',
                'options' => ['style' => 'width: 20%']
            ],
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => '/widget-carousel-item',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>


</div>
