<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>

<div class="error-page">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="headline">
                <?= property_exists($exception, 'statusCode') ? $exception->statusCode : 500 ?>
            </h2>
            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> <?= Html::encode($name) ?></h3>
                <p>
                    <?= nl2br(Html::encode($message)) ?>
                </p>
            </div>
        </div>
    </div>
</div><!-- /.error-page -->