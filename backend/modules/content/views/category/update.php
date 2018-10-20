<?php

/**
 * @var $this       yii\web\View
 * @var $model      common\models\ArticleCategory
 * @var $categories common\models\ArticleCategory[]
 */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Article Category',
    ]) . ' ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Article Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<?php echo $this->render('_form', [
    'model' => $model,
    'categories' => $categories,
]) ?>
