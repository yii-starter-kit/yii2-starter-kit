<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthAssignment */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Rbac Auth Assignment',
]) . ' ' . $model->item_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rbac Auth Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_name, 'url' => ['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="rbac-auth-assignment-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
