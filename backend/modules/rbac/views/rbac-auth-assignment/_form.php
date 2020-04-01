<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\User;
use backend\modules\rbac\models\RbacAuthItem;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthAssignment */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="rbac-auth-assignment-form">

    <?php $form = ActiveForm::begin() ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'item_name')->dropDownList(ArrayHelper::map(RbacAuthItem::find()->all(), 'name', 'name'), ['prompt' => Yii::t('backend', 'Please select an item...')]) ?>

    <?php echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'publicIdentity'), ['prompt' => Yii::t('backend', 'Please select an user...')]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
