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

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'component') ?>

    <?php echo $form->field($model, 'base_url') ?>

    <?php echo $form->field($model, 'path') ?>

    <?php echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'upload_ip') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
