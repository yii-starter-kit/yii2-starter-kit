<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
$this->title = $model->title;
?>
<div class="content">
    <h1><?php echo $model->title ?></h1>
    <?php echo $model->body ?>
</div>