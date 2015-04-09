<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Article
 */
?>
<div class="row">
    <div class="col-xs-12">
        <h2>
            <?= \yii\helpers\Html::a($model->title, ['view', 'id'=>$model->id]) ?>
        </h2>
        <div class="article-item">
            <?php if ($model->thumbnail_path): ?>
                <?php echo \yii\helpers\Html::img(
                    Yii::$app->glide->createSignedUrl([
                        'glide/index',
                        'path' => $model->thumbnail_path,
                        'w' => 100
                    ], true),
                    ['class' => 'article-thumb img-rounded pull-left']
                ) ?>
            <?php endif; ?>
            <div class="article-text">
                <?php echo \yii\helpers\StringHelper::truncate($model->body, 150)?>
            </div>
        </div>
    </div>
</div>