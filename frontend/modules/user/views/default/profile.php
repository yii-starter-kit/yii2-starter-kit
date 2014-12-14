<?php

use trntv\filekit\widget\SingleFileUpload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Profile')
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'picture')->widget(SingleFileUpload::classname(), [
        'url'=>['avatar-upload', 'category'=>'avatar']
    ]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'middlename')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>

    <?= $form->field($model, 'gender')->dropDownlist([
        \common\models\UserProfile::GENDER_FEMALE=>Yii::t('frontend', 'Female'),
        \common\models\UserProfile::GENDER_MALE=>Yii::t('frontend', 'Male'),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
