<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\modules\rbac\models\RbacAuthRule;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rbac-auth-item-form">

    <?php $form = ActiveForm::begin() ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'type')->dropDownList([1 => 'role', 2 => 'permission'], ['prompt' => Yii::t('backend', 'Please select a type...')]) ?>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'rule_name')->dropDownList(ArrayHelper::map(RbacAuthRule::find()->all(), 'name', 'name'), ['prompt' => Yii::t('backend', 'Please select a rule...')]) ?>

    <?php echo $form->field($model, 'data')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
