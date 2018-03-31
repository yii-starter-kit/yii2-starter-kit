<?php

/**
 * @var $this  yii\web\View
 * @var $model common\models\WidgetCarouselItem
 */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Widget Carousel Item',
    ]) . ' ' . $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Carousel Items'), 'url' => ['/widget/carousel/index']];
$this->params['breadcrumbs'][] = ['label' => $model->carousel->key, 'url' => ['/widget/carousel/update', 'id' => $model->carousel->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<?php echo $this->render('_form', [
    'model' => $model,
]) ?>
