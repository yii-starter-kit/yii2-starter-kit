<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\FileStorageItemSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="file-storage-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'repository') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'path') ?>

    <?= $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'mime') ?>

    <?php // echo $form->field($model, 'upload_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
