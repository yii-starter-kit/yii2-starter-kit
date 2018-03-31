<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\WidgetCarouselItem
 * @var $form  yii\bootstrap\ActiveForm
 */

?>

<?php $form = ActiveForm::begin() ?>

<?php echo $form->errorSummary($model) ?>

<?php echo $form->field($model, 'image')->widget(
    \trntv\filekit\widget\Upload::class,
    [
        'url' => ['/file/storage/upload'],
    ]
) ?>

<?php echo $form->field($model, 'order')->textInput() ?>

<?php echo $form->field($model, 'url')->textInput(['maxlength' => 1024]) ?>

<?php echo $form->field($model, 'caption')->widget(
    \yii\imperavi\Widget::class,
    [
        'plugins' => ['fullscreen', 'fontcolor', 'video'],
        'options' => [
            'minHeight' => 400,
            'maxHeight' => 400,
            'buttonSource' => true,
            'convertDivs' => false,
            'removeEmptyTags' => true,
        ],
    ]
) ?>

<?php echo $form->field($model, 'status')->checkbox() ?>

<div class="form-group">
    <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
