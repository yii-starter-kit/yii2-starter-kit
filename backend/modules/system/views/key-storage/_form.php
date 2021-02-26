<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var $this  yii\web\View
 * @var $model common\models\KeyStorageItem
 * @var $form  yii\bootstrap4\ActiveForm
 */

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
    <div class="card card-success">
        <?php if ($model->isNewRecord) : ?>
        <div class="card-header">
            <h3 class="card-title">
                <?php echo Yii::t('backend', 'Create a new key storage item') ?>
            </h3>
        </div>
        <?php endif; ?>
        <div class="card-body">
            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->field($model, 'key')->textInput() ?>

            <?php echo $form->field($model, 'value')->textInput() ?>

            <?php echo $form->field($model, 'comment')->textarea() ?>
        </div>
        <div class="card-footer">
            <?php echo Html::submitButton(
                $model->isNewRecord? FAS::icon('save').' '.Yii::t('backend', 'Create'):FAS::icon('save').' '. Yii::t('backend', 'Save Changes'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
