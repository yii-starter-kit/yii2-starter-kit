<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
$this->beginContent('@frontend/views/layouts/_clear.php')
?>
<?php $this->beginPage(); ?>
<?php
include('header.php'); ?>
    <body>
    <?php $this->beginBody() ?>
    <?php
    include('menu.php'); ?>

    <div class="container" style="height: auto;">
        <div class="section">
            <div class="row">
                <div class="col s12 m12">
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
    <?php
    include('footer.php'); ?>
    </body>
    </html>

<?php $this->endPage(); ?>