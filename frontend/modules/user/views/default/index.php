<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Account')
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'password_confirm')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
