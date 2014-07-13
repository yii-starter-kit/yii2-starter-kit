<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WidgetMenu */

$this->title = Yii::t('manager', 'Update {modelClass}: ', [
    'modelClass' => 'Widget Menu',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('manager', 'Widget Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('manager', 'Update');
?>
<div class="widget-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
