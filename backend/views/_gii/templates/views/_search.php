<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/**
 * @var yii\web\View $this
 * @var <?php echo ltrim($generator->modelClass, '\\') ?> $model
 * @var yii\bootstrap4\ActiveForm $form
 */
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
        echo "    <?php echo " . $generator->generateActiveSearchField($attribute) . " ?>\n";
    } else {
        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n";
    }
}
?>

    <div class="form-group">
        <?php echo "<?php echo " ?>Html::submitButton(<?php echo $generator->generateString('Search') ?>, ['class' => 'btn btn-primary']) ?>
        <?php echo "<?php echo " ?>Html::resetButton(<?php echo $generator->generateString('Reset') ?>, ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php echo "<?php " ?>ActiveForm::end(); ?>

</div>
