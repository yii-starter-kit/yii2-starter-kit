<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Page
 */

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'body')->widget(
    \yii\imperavi\Widget::class,
    [
        'plugins' => ['fullscreen', 'fontcolor', 'video'],
        'options' => [
            'minHeight' => 400,
            'maxHeight' => 400,
            'buttonSource' => true,
            'imageUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
        ],
    ]
) ?>

<?= $form->field($model, 'view')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
