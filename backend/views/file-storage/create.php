<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FileStorageItem */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'File Storage Item',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'File Storage Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-storage-item-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
