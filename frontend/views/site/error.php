<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */

$this->title = $name;
?>
<div class="site-error mt-5 text-center">

    <h1><?php echo Yii::t('frontend', 'Oops! There was an error...') ?></h1>
    <h3><?php echo Html::encode($this->title) ?></h3>

    <div class="alert alert-warning">
        <span class="fas fa-exclamation-triangle"></span> <?php echo nl2br(Html::encode($message)) ?>
    </div>

    <ul class="list-inline">
        <li class="list-inline-item">
            <?php echo Html::a('<span class="fas fa-home"></span> '.Yii::t('frontend', 'Go to Home'), ['/'], ['class' => ['btn', 'btn-primary', 'btn-lg']]) ?>
        </li>
        <li class="list-inline-item">
            <?php echo Html::a(
                '<span class="fas fa-envelope"></span> '.Yii::t('frontend', 'Contact Support'),
                ['site/contact'],
                ['class' => ['btn', 'btn-outline-secondary', 'btn-lg']]
            ) ?>
        </li>
    </ul>

</div>
