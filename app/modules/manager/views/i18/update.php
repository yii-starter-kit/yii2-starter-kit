<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\manager\models\I18Message */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'I18 Message',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'I18 Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="i18-message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
