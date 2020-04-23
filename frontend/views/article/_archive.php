<?php
/**
 * @var common\models\Article[] $archive
 * @var yii\web\View $this
 */

use yii\helpers\Html;
?>

<h4 class="text-muted mb-3"><?php echo Yii::t('frontend', 'Archive') ?></h4>
<ul class="list-group mb-3">
    <?php
    $currentYear = null;
    $blockBegin = Html::beginTag(
        'li',
        ['class' => 'list-group-item d-flex flex-column justify-content-between lh-condensed']
    );
    $blockEnd = Html::endTag('li');
    if (count($archive)) {
        foreach ($archive as $item) {
            $year = $item['year'];
            $month = $item['month'];
            $count = $item['count'];

            if ($currentYear !== $year) {
                // print Year
                echo $blockBegin, Html::tag('h6', $year, ['class' => 'my-0']);
            }
            echo Html::beginTag('div', ['class' => 'd-flex justify-content-between align-items-center']);
            // Print month name
            echo Html::a(
                Date('F', mktime(0, 0, 0, (int)$month, 1, (int)$year)),
                ['article/index', 'ArticleSearch[year]' => $year, 'ArticleSearch[month]' => $month],
                ['class' => 'text-muted']
            ), ' ', Html::tag('span', $count, ['class' => 'badge badge-secondary badge-pill']);
            echo Html::endTag('div');
            $currentYear = $year;
        }
        echo $blockEnd;
    } else {
        echo $blockBegin, Yii::t('frontend', 'No records'), $blockEnd;
    }
    ?>
</ul>