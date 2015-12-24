<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Article
 */
use yii\helpers\Html;
use Symfony\Component\DomCrawler\Crawler;
use common\helpers\StringHelper;
?>
<hr/>
<div class="article-item row">
    <div class="col-xs-12">
        <h2 class="article-title">
            <?php echo Html::a($model->title, ['view', 'slug'=>$model->slug]) ?>
        </h2>
        <div class="article-meta">
            <span class="article-date">
                <?php echo Yii::$app->formatter->asDatetime($model->created_at) ?>
            </span>,
            <span class="article-category">
                <?php echo Html::a(
                    $model->category->title,
                    ['index', 'ArticleSearch[category_id]' => $model->category_id]
                )?>
            </span>
        </div>
        <div class="article-content">
            <?php if ($model->thumbnail_path): ?>
                <?php echo Html::img(
                    Yii::$app->glide->createSignedUrl([
                        'glide/index',
                        'path' => $model->thumbnail_path,
                        'w' => 100
                    ], true),
                    ['class' => 'article-thumb img-rounded pull-left']
                ) ?>
            <?php endif; ?>
            <div class="article-text">
                <?php
                	//excerpt 5 lines and filter img
                	echo StringHelper::Excerpt($model->body, 5, '...', 90, Yii::$app->charset);
                ?>
            </div>
        </div>
    </div>
</div>
