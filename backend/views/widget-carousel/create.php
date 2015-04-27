<?php
/* @var $this yii\web\View */
/* @var $model common\models\WidgetCarousel */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Widget Carousel',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Carousels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-carousel-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
