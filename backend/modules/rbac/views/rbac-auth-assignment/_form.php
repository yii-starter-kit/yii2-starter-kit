<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use common\models\User;
use backend\modules\rbac\models\RbacAuthItem;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthAssignment */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
    <div class="card">
        <div class="card-body">
            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->field($model, 'item_name')->dropDownList(ArrayHelper::map(RbacAuthItem::find()->all(), 'name', 'name'), ['prompt' => Yii::t('backend', 'Please select an item...')]) ?>

            <?php echo $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'publicIdentity'), ['prompt' => Yii::t('backend', 'Please select an user...')]) ?>

        </div>
        <div class="card-footer">
            <?php echo Html::submitButton(
                $model->isNewRecord? FAS::icon('save').' '.Yii::t('backend', 'Create'):FAS::icon('save').' '. Yii::t('backend', 'Save Changes'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
