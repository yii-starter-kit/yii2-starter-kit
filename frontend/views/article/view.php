<?php
/**
 * @var yii\web\View $this
 * @var common\models\Article $model
 * @var array $categories
 * @var array $archive
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-sm-8 col-lg-9">
        <h1 class="mt-4"><?php echo Html::encode($model->title) ?></h1>

        <p class="lead">
            <?php echo Yii::t('frontend', 'by {author} on {published_at} in {category}', [
                'published_at' => Yii::$app->formatter->asDate($model->published_at),
                'author' => $model->author->getPublicIdentity(),
                'category' => Html::a(
                    Html::encode($model->category->title),
                    ['article/index', 'ArticleSearch[category_id]' => $model->category_id],
                    ['class' => ['btn', 'btn-outline-secondary', 'btn-sm']]
                )
            ]) ?>
        </p>
        <hr>

        <p class="text-muted text-sm">
            <?php echo Yii::t('frontend', 'Last updated on {updated_at} by {updater}', [
                'updated_at' => Yii::$app->formatter->asDate($model->updated_at),
                'updater' => $model->updater->getPublicIdentity(),
            ]) ?>
        </p>
        <hr>

        <?php if ($model->thumbnail_path) : ?>
            <?php echo \yii\helpers\Html::img(
                Yii::$app->glide->createSignedUrl([
                    'glide/index',
                    'path' => $model->thumbnail_path,
                    'w' => 200
                ], true),
                ['class' => 'img-fluid img-rounded']
            ) ?>
            <hr>
        <?php endif; ?>

        <?php echo HtmlPurifier::process($model->body) ?>

        <?php if (!empty($model->articleAttachments)): ?>
            <h3><?php echo Yii::t('frontend', 'Attachments') ?></h3>
            <ul id="article-attachments">
                <?php foreach ($model->articleAttachments as $attachment): ?>
                    <li>
                        <?php echo \yii\helpers\Html::a(
                            Html::encode($attachment->name),
                            ['attachment-download', 'id' => $attachment->id])
                        ?>
                        (<?php echo Yii::$app->formatter->asSize($attachment->size) ?>)
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="col-sm-4 col-lg-3">
        <?php echo $this->render('_categories', ['categories' => $categories]) ?>
        <?php echo $this->render('_archive', ['archive' => $archive]) ?>
    </div>
</div>