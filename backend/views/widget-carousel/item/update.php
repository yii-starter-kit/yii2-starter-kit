<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetCarouselItem */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Widget Carousel Item',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Carousel Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->carousel->key, 'url' => ['update', 'id' => $model->carousel->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="widget-carousel-item-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
