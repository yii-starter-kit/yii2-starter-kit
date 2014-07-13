<?php
/* @var $this \yii\web\View */
use yii\widgets\Breadcrumbs;

/* @var $content string */

$this->beginContent('@app/views/layouts/_base.php')
?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
<?php $this->endContent() ?>