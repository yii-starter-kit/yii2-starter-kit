<?php

use trntv\filekit\widget\Upload;
use kartik\datetime\DateTimePicker;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;
use rmrevin\yii\fontawesome\FAS;

/**
 * @var yii\web\View $this
 * @var common\models\Article $model
 * @var common\models\ArticleCategory[] $categories
 */
?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>
    <div class="card">
        <div class="card-body">
            <?php echo $form->errorSummary($model) ?>
            <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'slug')
                ->hint(Yii::t('backend', 'If you leave this field empty, the slug will be generated automatically'))
                ->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                $categories,
                'id',
                'title'
            ), ['prompt' => '']) ?>

            <?php echo $form->field($model, 'body')->widget(
                \yii\imperavi\Widget::class,
                [
                    'plugins' => ['fullscreen', 'fontcolor', 'video'],
                    'options' => [
                        'minHeight' => 400,
                        'maxHeight' => 400,
                        'buttonSource' => true,
                        'convertDivs' => false,
                        'removeEmptyTags' => true,
                        'imageUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
                    ],
                ]
            ) ?>

            <?php echo $form->field($model, 'thumbnail')->widget(
                Upload::class,
                [
                    'url' => ['/file/storage/upload'],
                    'maxFileSize' => 5000000, // 5 MiB,
                    'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
                ]
            ) ?>

            <?php echo $form->field($model, 'attachments')->widget(
                Upload::class,
                [
                    'url' => ['/file/storage/upload'],
                    'sortable' => true,
                    'maxFileSize' => 10000000, // 10 MiB
                    'maxNumberOfFiles' => 10,
                ]
            ) ?>

            <?php echo $form->field($model, 'view')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'status')->checkbox() ?>

            <div class="border border-secondary rounded p-1" style="width:320px">
                <?php echo $form->field($model, 'published_at')->widget(
                    DateTimePicker::class,
                    [
                        'type' => DateTimePicker::TYPE_INLINE,
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd HH:mm:ss',
                            'showMeridian' => true,
                            'todayBtn' => true,
                        ]
                    ]
                ) ?>
            </div>
        </div>
        <div class="card-footer">
            <?php echo Html::submitButton(
                $model->isNewRecord? FAS::icon('save').' '.Yii::t('backend', 'Create'):FAS::icon('save').' '. Yii::t('backend', 'Save Changes'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
