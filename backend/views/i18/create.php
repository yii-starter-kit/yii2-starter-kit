<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\\models\I18Message */

$this->title = Yii::t('common', 'Create {modelClass}', [
    'modelClass' => 'I18 Message',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'I18 Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
