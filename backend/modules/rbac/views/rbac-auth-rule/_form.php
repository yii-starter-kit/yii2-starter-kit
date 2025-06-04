<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthRule */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
    <div class="card">
        <div class="card-body">

            <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'data')->textInput() ?>

        </div>
        <div class="card-footer">
            <?php echo Html::submitButton(
                $model->isNewRecord? FAS::icon('save').' '.Yii::t('backend', 'Create'):FAS::icon('save').' '. Yii::t('backend', 'Save Changes'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
