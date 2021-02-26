<?php

use common\grid\EnumColumn;
use common\models\ArticleCategory;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var $this         yii\web\View
 * @var $searchModel  backend\modules\content\models\search\ArticleCategorySearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        ArticleCategory
 * @var $categories   common\models\ArticleCategory[]
 */

$this->title = Yii::t('backend', 'Article Categories');
$this->params['breadcrumbs'][] = $this->title;
?>


<?php echo $this->render('_form', [
    'model' => $model,
    'categories' => $categories,
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
                [
                    'attribute' => 'id',
                    'options' => ['style' => 'width: 5%'],
                ],
                [
                    'attribute' => 'slug',
                    'options' => ['style' => 'width: 15%'],
                ],
                [
                    'attribute' => 'title',
                    'value' => function ($model) {
                        return Html::a(Html::encode($model->title), ['update', 'id' => $model->id]);
                    },
                    'format' => 'raw',
                ],
                [
                    'class' => EnumColumn::class,
                    'attribute' => 'status',
                    'options' => ['style' => 'width: 10%'],
                    'enum' => ArticleCategory::statuses(),
                    'filter' => ArticleCategory::statuses(),
                ],
                [
                    'class' => \common\widgets\ActionColumn::class,
                    'options' => ['style' => 'width: 5%'],
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
    <div class="card-footer">
        <?php echo getDataProviderSummary($dataProvider) ?>
    </div>
</div>

