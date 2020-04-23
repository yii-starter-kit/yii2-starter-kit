<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var common\models\UserProfile $model
 * @var yii\bootstrap4\ActiveForm $form
 */

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