<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WidgetMenu */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Widget Menu',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Widget Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="widget-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
