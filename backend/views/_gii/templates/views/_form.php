<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

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

<div class="<?php echo Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
    <?php echo "<?php " ?>$form = ActiveForm::begin(); ?>
        <div class="card">
            <div class="card-body">
                <?php echo "<?php echo " ?>$form->errorSummary($model); ?>

                <?php foreach ($generator->getColumnNames() as $attribute) {
                    if (in_array($attribute, $safeAttributes)) {
                        echo "<?php echo " . $generator->generateActiveField($attribute) . " ?>\n                ";
                    }
                } ?>

            </div>
            <div class="card-footer">
                <?php echo "<?php echo " ?>Html::submitButton($model->isNewRecord ? <?php echo $generator->generateString('Create') ?> : <?php echo $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    <?php echo "<?php " ?>ActiveForm::end(); ?>
</div>
