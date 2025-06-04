<?php

use yii\grid\GridView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  backend\modules\system\models\search\KeyStorageItemSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\KeyStorageItem
 */

$this->title = Yii::t('backend', 'Key Storage Items');

$this->params['breadcrumbs'][] = $this->title;

?>

<?php echo $this->render('_form', [
    'model' => $model,
]) ?>

<div class="card">
    <div class="card-body p-0">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'options' => [
                'class' => ['gridview', 'table-responsive'],
            ],
            'tableOptions' => [
                'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'key',
                'value',

                [
                    'class' => \common\widgets\ActionColumn::class,
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>


