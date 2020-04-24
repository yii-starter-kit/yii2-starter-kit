<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Article
 */
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\StringHelper;
?>

<div class="card mb-4">
    <!-- card image -->
    <?php if ($model->thumbnail_path) : ?>
        <?php echo Html::img(
            Yii::$app->glide->createSignedUrl([
                'glide/index',
                'path' => $model->thumbnail_path,
                'w' => 100
            ], true),
            ['class' => 'card-img-top']
        ) ?>
    <?php endif; ?>
    <!-- /card image -->

    <!-- card body -->
    <div class="card-body d-flex flex-column align-items-start">
        <?php echo Html::a(
            Html::encode($model->title),
            ['view', 'slug'=>$model->slug],
            ['class' => ['h3', 'text-decoration-none', 'card-title']]
        ) ?>

        <p class="card-text">
            <?php echo StringHelper::truncate(HtmlPurifier::process($model->body), 400, '...', null, true) ?>
        </p>

        <?php echo Html::a(
            Html::encode(Yii::t('frontend', 'Read More ')). ' <i class="fas fa-arrow-right"></i>',
            ['view', 'slug'=>$model->slug],
            ['class' => ['btn', 'btn-primary']]
        ) ?>
    </div>
    <!-- /card body -->

    <!-- card footer-->
    <div class="card-footer d-flex d-flex-row align-items-center justify-content-between">
        <div class="text-muted">
            <?php echo Yii::t('frontend', 'Posted by {author} on {published_at}', [
                'published_at' => Yii::$app->formatter->asDate($model->published_at),
                'author' => $model->author->getPublicIdentity(),
            ]) ?>
        </div>

        <div>
            <?php echo Html::a(
                Html::encode($model->category->title),
                ['article/index', 'ArticleSearch[category_id]' => $model->category_id],
                ['class' => ['btn', 'btn-outline-secondary', 'btn-sm']]
            ) ?>
        </div>
    </div>
    <!-- /card footer-->
</div>
