<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 1024]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 512]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
        $categories,
        'id',
        'title'
    ), ['prompt'=>'']) ?>

    <?= $form->field($model, 'body')->widget(
        \yii\imperavi\Widget::className(),
        [
            'plugins' => ['fullscreen'],
            'options'=>[
                'minHeight'=>400,
                'maxHeight'=>400,
                'buttonSource'=>true,
                'convertDivs'=>false,
                'removeEmptyTags'=>false,
                'imageUpload'=>Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
            ]
        ]
    ) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'published_at')->widget('trntv\yii\datetimepicker\DatetimepickerWidget') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
