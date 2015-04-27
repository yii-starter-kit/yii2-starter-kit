<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $roles yii\rbac\Role[] */

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => 'User']) . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->email, 'url' => ['view', 'id' => $model->email]];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('backend', 'Update')];
?>
<div class="user-update">

    <?php echo $this->render('_form', [
        'model' => $model,
        'roles' => $roles
    ]) ?>

</div>
