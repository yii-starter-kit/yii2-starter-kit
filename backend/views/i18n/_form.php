<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\\models\I18Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="i18-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <dl>
            <dt><?= \Yii::t('backend', 'Source message') ?></dt>
            <dd><?= $model->source->message ?></dd>
        </dl>
    </div>

    <?= $form->field($model, 'language')->textInput(['maxlength' => 16, 'disabled'=>1]) ?>

    <?= $form->field($model, 'translation')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
