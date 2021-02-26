<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
$statusCode = property_exists($exception, 'statusCode') ? $exception->statusCode : 500;
$textColor = $statusCode == 500? 'danger': 'warning';
?>

    <div class="error-page">
    <h2 class="headline text-<?php echo $textColor?>"><?php echo $statusCode ?></h2>

    <div class="error-content">
        <h3 class="font-weight-bold"><?php echo FAS::icon('exclamation-triangle', ['class' => "text-$textColor"]).' '.nl2br(Html::encode($message)) ?></h3>

        <p>
            <?php echo Yii::t('backend', 'Oops! Something went wrong... You may audit the error by reviewing the system logs or the application timeline.') ?>
        </p>
        <ul class="list-inline">
            <li class="list-inline-item">
                <?php echo Html::a(FAS::icon('stream').' '.Yii::t('backend', 'Go to timeline'), ['/timeline-event/index'], ['class' => ['btn', 'btn-primary', 'btn-lg']]) ?>
            </li>
            <li class="list-inline-item">
                <?php echo Html::a(FAS::icon('clipboard-list').' '.Yii::t('backend', 'Go to logs'), ['/system/log/index'], ['class' => ['btn', 'btn-secondary', 'btn-lg']]) ?>
            </li>
        </ul>
    </div>
</div>