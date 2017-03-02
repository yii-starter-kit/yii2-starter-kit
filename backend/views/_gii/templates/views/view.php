<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?php echo ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?php echo $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?php echo $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?php echo Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">

    <p>
        <?php echo "<?php echo " ?>Html::a(<?php echo $generator->generateString('Update') ?>, ['update', <?php echo $urlParams ?>], ['class' => 'btn btn-primary']) ?>
        <?php echo "<?php echo " ?>Html::a(<?php echo $generator->generateString('Delete') ?>, ['delete', <?php echo $urlParams ?>], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => <?php echo $generator->generateString('Are you sure you want to delete this item?') ?>,
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo "<?php echo " ?>DetailView::widget([
        'model' => $model,
        'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "            '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
    }
}
?>
        ],
    ]) ?>

</div>
