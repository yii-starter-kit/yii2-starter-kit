<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItem */

$this->title = Yii::t('frontend', 'Create Rbac Auth Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Rbac Auth Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-auth-item-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
