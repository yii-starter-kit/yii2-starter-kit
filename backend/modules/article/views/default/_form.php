<?php

use trntv\filekit\widget\Upload;
use trntv\yii\datetime\DateTimeWidget;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

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

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'slug')
    ->hint(Yii::t('backend', 'If you\'ll leave this field empty, slug will be generated automatically'))
    ->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
    $categories,
    'id',
    'title'
), ['prompt' => '']) ?>

<?= $form->field($model, 'body')->widget(
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

<?= $form->field($model, 'thumbnail')->widget(
    Upload::class,
    [
        'url' => ['/file/storage/upload'],
        'maxFileSize' => 5000000, // 5 MiB
    ]);
?>

<?= $form->field($model, 'attachments')->widget(
    Upload::class,
    [
        'url' => ['/file/storage/upload'],
        'sortable' => true,
        'maxFileSize' => 10000000, // 10 MiB
        'maxNumberOfFiles' => 10,
    ]);
?>

<?= $form->field($model, 'view')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status')->checkbox() ?>

<?= $form->field($model, 'published_at')->widget(
    DateTimeWidget::class,
    [
        'phpDatetimeFormat' => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ',
    ]
) ?>

<div class="form-group">
    <?= Html::submitButton(
        $model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
