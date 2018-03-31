<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItemChild */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Rbac Auth Item Child',
]) . $model->parent;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Rbac Auth Item Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->parent, 'url' => ['view', 'parent' => $model->parent, 'child' => $model->child]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="rbac-auth-item-child-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
