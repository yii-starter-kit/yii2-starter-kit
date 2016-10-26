<?php
/* @var $this yii\web\View */
/* @var $model common\models\WidgetText */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => '文本块',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Text Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-block-create">

    <?php echo $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
