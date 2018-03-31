<?php

/**
 * @var $this  yii\web\View
 * @var $model common\models\WidgetText
 */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Text Block',
    ]) . ' ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Text Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<?php echo $this->render('_form', [
    'model' => $model,
]) ?>
