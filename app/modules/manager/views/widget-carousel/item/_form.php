<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WidgetCarouselItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="widget-carousel-item-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <?php if($model->path): ?>
        <div class="row">
            <div class="col-xs-12 text-center">
                <?= Html::img($model->path, ['style'=>'max-width: 100%']) ?>
            </div>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 1024]) ?>

    <?= $form->field($model, 'caption')->widget(
        \yii\imperavi\Widget::className(),
        [
            'plugins' => ['fullscreen'],
            'options'=>[
                'minHeight'=>400,
                'maxHeight'=>400,
                'toolbarFixed'=>true,
                'convertDivs'=>false,
                'removeEmptyTags'=>false
            ]
        ]) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
