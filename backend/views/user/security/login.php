<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="login-box">
    <div class="login-logo">
        <?php echo Html::encode($this->title) ?>
    </div><!-- /.login-logo -->
    <div class="header"></div>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin([
                    'id'                     => 'login-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                    'validateOnType'         => false,
                    'validateOnChange'       => false,
                ]) ?>
        <div class="body">
             <?= $form->field($model, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]) ?>

            <?= $form
                ->field($model, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])
                ->passwordInput()
                ->label(Yii::t('user', 'Password'))?>

            <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>
        </div>
        <div class="footer">
            <?= Html::submitButton(Yii::t('user', 'Sign in'), ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>