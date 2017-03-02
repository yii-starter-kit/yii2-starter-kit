<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?php echo ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="<?php echo Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?php echo "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "    <?php echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    } else {
        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    }
}
?>
    <div class="form-group">
        <?php echo "<?php echo " ?>Html::submitButton(<?php echo $generator->generateString('Search') ?>, ['class' => 'btn btn-primary']) ?>
        <?php echo "<?php echo " ?>Html::resetButton(<?php echo $generator->generateString('Reset') ?>, ['class' => 'btn btn-default']) ?>
    </div>

    <?php echo "<?php " ?>ActiveForm::end(); ?>

</div>
