<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('backend', 'Sign In');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="login-box">
    <div class="login-logo">
        <?php echo Html::encode($this->title) ?>
    </div><!-- /.login-logo -->
    <div class="header"></div>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="body">
            <?php echo $form->field($model, 'username') ?>
            <?php echo $form->field($model, 'password')->passwordInput() ?>
            <?php echo $form->field($model, 'rememberMe')->checkbox(['class'=>'simple']) ?>
        </div>
        <div class="footer">
            <?php echo Html::submitButton(Yii::t('backend', 'Sign me in'), [
                'class' => 'btn btn-primary btn-flat btn-block',
                'name' => 'login-button'
            ]) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>

</div>