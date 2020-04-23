<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\bootstrap4\ActiveForm $form
 * @var frontend\modules\user\models\ResendEmailForm $model
 */

$this->title =  Yii::t('frontend', 'Resend activation email');
?>

<?php $form = ActiveForm::begin(['id' => 'resend-email']); ?>
<div class="site-resend mt-5">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card mb-2">
                <div class="card-body">
                    <h1 class="h4 text-muted text-center"><?php echo Html::encode($this->title) ?></h1>
                    <?php echo $form->field($model, 'email')->input('email') ?>
                    <div class="form-group">
                        <?php echo Html::submitButton(Yii::t('frontend', 'Send Email'), ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>