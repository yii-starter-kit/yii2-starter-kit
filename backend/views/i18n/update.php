<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\\models\I18Message */

$this->title = Yii::t('backend', 'Update message'). ': ' . $model->source->message;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'I18 Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'language' => $model->language]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="i18-message-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
