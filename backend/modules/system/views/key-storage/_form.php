<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\KeyStorageItem
 * @var $form  yii\bootstrap\ActiveForm
 */

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>

<?= $form->field($model, 'key')->textInput() ?>

<?= $form->field($model, 'value')->textInput() ?>

<?= $form->field($model, 'comment')->textarea() ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
