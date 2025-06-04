<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var <?php echo ltrim($generator->modelClass, '\\') ?> $model
 */

$this->title = $model-><?php echo $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?php echo $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?php echo Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
    <div class="card">
        <div class="card-header">
            <?php echo "<?php echo " ?>Html::a(<?php echo $generator->generateString('Update') ?>, ['update', <?php echo $urlParams ?>], ['class' => 'btn btn-primary']) ?>
            <?php echo "<?php echo " ?>Html::a(<?php echo $generator->generateString('Delete') ?>, ['delete', <?php echo $urlParams ?>], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => <?php echo $generator->generateString('Are you sure you want to delete this item?') ?>,
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="card-body">
            <?php echo "<?php echo " ?>DetailView::widget([
                'model' => $model,
                'attributes' => [
                    <?php
                    if (($tableSchema = $generator->getTableSchema()) === false) {
                        foreach ($generator->getColumnNames() as $name) {
                            echo "'" . $name . "',\n                    ";
                        }
                    } else {
                        foreach ($generator->getTableSchema()->columns as $column) {
                            $format = $generator->generateColumnFormat($column);
                            echo "'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n                    ";
                        }
                    }
                    ?>

                ],
            ]) ?>
        </div>
    </div>
</div>
