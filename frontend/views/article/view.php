<?php
/* @var $this yii\web\View */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <h1><?= $model->title ?></h1>
    <?= $model->body ?>
</div>