<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var common\models\WidgetCarouselItem $model
 * @var yii\bootstrap4\ActiveForm $form
 */

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
    <div class="card card-success">
        <div class="card-body">
            <?php echo $form->errorSummary($model) ?>

            <?php echo $form->field($model, 'image')->widget(
                \trntv\filekit\widget\Upload::class,
                [
                    'url' => ['/file/storage/upload'],
                ]
            ) ?>

            <?php echo $form->field($model, 'order')->textInput() ?>

            <?php echo $form->field($model, 'url')->textInput(['maxlength' => 1024]) ?>

            <?php echo $form->field($model, 'caption')->widget(
                \yii\imperavi\Widget::class,
                [
                    'plugins' => ['fullscreen', 'fontcolor', 'video'],
                    'options' => [
                        'minHeight' => 400,
                        'maxHeight' => 400,
                        'buttonSource' => true,
                        'convertDivs' => false,
                        'removeEmptyTags' => true,
                    ],
                ]
            ) ?>

            <?php echo $form->field($model, 'status')->checkbox() ?>
        </div>
        <div class="card-footer">
            <?php echo Html::submitButton(
                $model->isNewRecord? FAS::icon('save').' '.Yii::t('backend', 'Create'):FAS::icon('save').' '. Yii::t('backend', 'Save Changes'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>