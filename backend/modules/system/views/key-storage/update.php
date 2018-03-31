<?php

/**
 * @var $this  yii\web\View
 * @var $model common\models\KeyStorageItem
 */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Key Storage Item',
    ]) . ' ' . $model->key;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Key Storage Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<?php echo $this->render('_form', [
    'model' => $model,
]) ?>
