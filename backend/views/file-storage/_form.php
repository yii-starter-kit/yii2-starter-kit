<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FileStorageItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-storage-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'repository')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'size')->textInput() ?>

    <?= $form->field($model, 'mime')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'upload_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
