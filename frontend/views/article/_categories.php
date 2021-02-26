<?php
/**
 * @var common\models\ArticleCategory[] $categories
 * @var yii\web\View $this
 */

use yii\helpers\Html;
?>

<h4 class="text-muted mb-3"><?php echo Yii::t('frontend', 'Categories') ?></h4>
<ul class="list-group mb-3">
    <?php
    $blockBegin = Html::beginTag(
        'li',
        ['class' => 'list-group-item d-flex flex-column justify-content-between lh-condensed']
    );
    $blockEnd = Html::endTag('li');
    echo $blockBegin;
    if (count($categories)) {
        foreach ($categories as $category) {
            $label = $category['title'];
            $slug = $category['slug'];
            $count = $category['articlesCount'];

            echo Html::beginTag('div', ['class' => 'd-flex justify-content-between align-items-center']);
            echo Html::a(
                Html::encode($label),
                ['article/index', 'ArticleSearch[category_id]' => $category['id']],
                ['class' => 'text-muted overflow-hidden']
            ), ' ', Html::tag('span', $count, ['class' => 'badge badge-secondary badge-pill']);
            echo Html::endTag('div');
        }
    } else {
        echo Yii::t('frontend', 'Categories not found');
    }
    echo $blockEnd;
    ?>
</ul>