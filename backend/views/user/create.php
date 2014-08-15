<?php

use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'User',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'status')->label(Yii::t('backend', 'Active'))->checkbox() ?>
        <?= $form->field($model, 'role')->dropdownList(User::getRoles()) ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('frontend', 'Create'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
