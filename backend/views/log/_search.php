<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\SystemLogSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="system-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'level') ?>

    <?php echo $form->field($model, 'category') ?>

    <?php echo $form->field($model, 'log_time') ?>

    <?php echo $form->field($model, 'prefix') ?>

    <?php echo $form->field($model, 'message') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
