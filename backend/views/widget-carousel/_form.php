<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetCarousel */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="widget-carousel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'key')->textInput(['maxlength' => 1024]) ?>

    <?php echo $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
