<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap4\ActiveForm */
$this->title = Yii::t('backend', 'Edit account')
?>

<?php $form = ActiveForm::begin() ?>
<div class="user-profile-form card">
    <div class="card-body">
        <?php echo $form->field($model, 'username') ?>
        <?php echo $form->field($model, 'email')->input('email') ?>
        <?php echo $form->field($model, 'password')->passwordInput() ?>
        <?php echo $form->field($model, 'password_confirm')->passwordInput() ?>
    </div>
    <div class="card-footer">
        <?php echo Html::submitButton(FAS::icon('save').' '.Yii::t('backend', 'Save Changes'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>