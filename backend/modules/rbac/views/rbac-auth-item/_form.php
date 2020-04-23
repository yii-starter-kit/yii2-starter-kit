<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\modules\rbac\models\RbacAuthRule;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
    <div class="card">
        <div class="card-body">

            <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'type')->dropDownList([1 => 'role', 2 => 'permission'], ['prompt' => Yii::t('backend', 'Please select a type...')]) ?>

            <?php echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?php echo $form->field($model, 'rule_name')->dropDownList(ArrayHelper::map(RbacAuthRule::find()->all(), 'name', 'name'), ['prompt' => Yii::t('backend', 'Please select a rule...')]) ?>

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
