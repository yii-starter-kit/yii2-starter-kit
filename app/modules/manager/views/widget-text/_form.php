<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WidgetText */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="text-block-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 1024]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

    <?= $form->field($model, 'body')->widget(\yii\imperavi\Widget::className(), [
        // Some options, see http://imperavi.com/redactor/docs/
        'plugins' => ['fullscreen'],
        'options'=>[
            'minHeight'=>400,
            'maxHeight'=>400,
            'toolbarFixed'=>true,
            'convertDivs'=>false,
            'removeEmptyTags'=>false,
            'imageUpload'=>Yii::$app->urlManager->createUrl(['/manager/file-manager/upload-imperavi'])

        ]
    ]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
