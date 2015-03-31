<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NewsCategory */

$this->title = Yii::t('backend', 'Create News Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'News Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
