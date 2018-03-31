<?php

/**
 * @var $this  yii\web\View
 * @var $model common\models\WidgetMenu
 */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Widget Menu',
    ]) . ' ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<?php echo $this->render('_form', [
    'model' => $model,
]) ?>
