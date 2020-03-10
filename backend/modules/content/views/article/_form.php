<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;

/**
 * @var $this       yii\web\View
 * @var $model      common\models\Article
 * @var $categories common\models\ArticleCategory[]
 */

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>

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
    ]);
?>

<?php echo $form->field($model, 'attachments')->widget(
    Upload::class,
    [
        'url' => ['/file/storage/upload'],
        'sortable' => true,
        'maxFileSize' => 10000000, // 10 MiB
        'maxNumberOfFiles' => 10,
    ]);
?>

<?php echo $form->field($model, 'view')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'status')->checkbox() ?>

<?php echo $form->field($model, 'published_at')->widget(
    DateTimeWidget::class,
    [
        'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ',
    ]
) ?>

<div class="form-group">
    <?php echo Html::submitButton(
        $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
