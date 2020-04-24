<?php

/**
 * @var yii\web\View $this
 * @var common\models\Article $model
 * @var common\models\ArticleCategory[] $categories
 */
$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'Article',
    ]) . ' ' . $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<?php echo $this->render('_form', [
    'model' => $model,
    'categories' => $categories,
]) ?>
