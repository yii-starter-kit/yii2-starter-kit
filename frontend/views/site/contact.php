<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\bootstrap\ActiveForm $form
 * @var frontend\models\ContactForm $model
 */

$this->title = Yii::t('frontend', 'Contact us');
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1><?php echo Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?php echo $form->field($model, 'name') ?>
                <?php echo $form->field($model, 'email')->input('email') ?>
                <?php echo $form->field($model, 'subject') ?>
                <?php echo $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?php echo $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
