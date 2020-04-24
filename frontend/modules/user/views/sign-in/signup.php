<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\bootstrap4\ActiveForm $form
 * @var frontend\modules\user\models\SignupForm $model
 */

$this->title = Yii::t('frontend', 'Sign up');
?>

<?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>
<div class="signup mt-5">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card mb-2">
                <div class="card-body">
                    <h1 class="text-muted text-center"><?php echo Html::encode($this->title) ?></h1>
                    <?php echo $form->errorSummary($model) ?>
                    <?php echo $form->field($model, 'username') ?>
                    <?php echo $form->field($model, 'email') ?>
                    <?php echo $form->field($model, 'password')->passwordInput() ?>
                    <?php echo $form->field($model, 'password_confirm')->passwordInput() ?>

                    <div class="form-group">
                        <?php echo Html::submitButton(Yii::t('frontend', 'Sign up'), ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'signup-button']) ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="text-muted text-center"><?php echo Yii::t('frontend', 'Sign up with')  ?></h4>

                    <?php $authAuthChoice = yii\authclient\widgets\AuthChoice::begin([
                        'baseAuthUrl' => ['site/auth']
                    ]); ?>
                    <ul class="list-inline d-flex justify-content-center">
                        <?php foreach ($authAuthChoice->getClients() as $client) : ?>
                            <li class="list-inline-item"><?= $authAuthChoice->clientLink($client) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php yii\authclient\widgets\AuthChoice::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>