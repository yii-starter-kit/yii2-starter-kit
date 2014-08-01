<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>


<div class="error-page">
    <h2 class="headline">
        <?= property_exists($exception, 'statusCode') ? $exception->statusCode : 500 ?>
    </h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> <?= Html::encode($name) ?></h3>
        <p>
            <?= nl2br(Html::encode($message)) ?>
        </p>
        <form class='search-form'>
            <div class='input-group'>
                <input type="text" name="search" class='form-control' placeholder="Search"/>
                <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                </div>
            </div><!-- /.input-group -->
        </form>
    </div>
</div><!-- /.error-page -->