<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FileStorageItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="file-storage-item-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'repository')->dropDownList(
        Yii::$app->fileStorage->getAvailableRepositories(),
        ['prompt'=>'']
    ) ?>

    <?= $form->field($model, 'path')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
