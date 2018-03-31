<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="error">
    <div class="row">
        <div class="col-xs-12">
            <div class="error-content text-center">
                <h3 class="headline">
                    <i class="fa fa-warning text-yellow"></i>
                    <?php echo Yii::t(
                        'backend',
                        'Error {code}',
                        [
                            'code' => property_exists($exception, 'statusCode') ? $exception->statusCode : 500
                        ])
                    ?>
                </h3>
                <p>
                    <?php echo nl2br(Html::encode($message)) ?>
                </p>
            </div>
        </div>
    </div>
</div><!-- /.error-page -->