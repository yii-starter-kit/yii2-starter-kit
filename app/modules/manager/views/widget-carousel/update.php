<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WidgetCarousel */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Widget Carousel',
]) . ' ' . $model->alias;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="widget-carousel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
            'modelClass' => 'Widget Carousel Item',
        ]), ['/manager/widget-carousel-item/create', 'carousel_id'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $carouselItemsProvider,
        'columns' => [
            'order',
            [
                'attribute'=>'path',
                'format'=>'raw',
                'value'=>function($model){
                    return $model->path ? Html::img($model->path, ['style'=>'max-width: 100px']) : null;
                }
            ],
            'url:url',
            'caption',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller'=>'/manager/widget-carousel-item',
                'template'=>'{update} {delete}'
            ],
        ],
    ]); ?>


</div>
