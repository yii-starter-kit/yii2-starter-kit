<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WidgetCarouselItem */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Widget Carousel Item',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Carousel'), 'url' => ['/manager/widget-carousel/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-carousel-item-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
