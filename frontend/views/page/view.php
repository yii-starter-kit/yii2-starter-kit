<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = $model->title;
?>

<h1 class="mt-4"><?php echo Html::encode($model->title) ?></h1>
<?php echo HtmlPurifier::process($model->body) ?>