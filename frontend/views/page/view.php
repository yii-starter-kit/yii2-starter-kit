<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
$this->title = $model->title;
?>
<div class="content">
    <h1><?= $model->title ?></h1>
    <?= $model->body ?>
</div>