<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WidgetText */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => '文本块',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Text Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="text-block-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
