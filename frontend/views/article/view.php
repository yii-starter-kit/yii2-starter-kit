<?php
/* @var $this yii\web\View */
/* @var $model common\models\Article */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <article>
        <h1><?= $model->title ?></h1>

        <?= $model->body ?>

        <?php if (!empty($model->articleAttachments)): ?>
            <h3><?php echo Yii::t('frontend', 'Attachments') ?></h3>
            <ul id="article-attachments">
                <?php foreach ($model->articleAttachments as $attachment): ?>
                    <li>
                        <?php echo \yii\helpers\Html::a($attachment->name, $attachment->url) ?>
                        - <?php echo Yii::$app->formatter->asSize($attachment->size) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </article>
</div>