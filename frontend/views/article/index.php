<?php

/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \frontend\models\search\ArticleSearch $searchModel
 */

$this->title = Yii::t('frontend', 'Articles')
?>
<div class="container">
    <h1 class="mt-4">
        <?php echo Yii::t('frontend', 'Articles') ?>
    </h1>

    <div class="row">
        <div class="col-sm-8 col-lg-9">
            <?php echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'hideOnSinglePage' => true,
                ],
                'itemView' => '_item'
            ])?>
        </div>

        <div class="col-sm-4 col-lg-3">
            <?php echo $this->render('_categories', ['categories' => $categories]) ?>
            <?php echo $this->render('_archive', ['archive' => $archive]) ?>
        </div>
    </div>
</div>
