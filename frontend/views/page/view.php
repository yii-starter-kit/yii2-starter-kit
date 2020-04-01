<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = $model->title;
?>
<div class="content">
    <h1><?php echo Html::encode($model->title) ?></h1>
    <?php echo HtmlPurifier::process($model->body) ?>
</div>