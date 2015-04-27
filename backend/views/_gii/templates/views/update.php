<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?php echo ltrim($generator->modelClass, '\\') ?> */

$this->title = <?php echo $generator->generateString('Update {modelClass}: ', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?> . ' ' . $model-><?php echo $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?php echo $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model-><?php echo $generator->getNameAttribute() ?>, 'url' => ['view', <?php echo $urlParams ?>]];
$this->params['breadcrumbs'][] = <?php echo $generator->generateString('Update') ?>;
?>
<div class="<?php echo Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-update">

    <?php echo "<?php echo " ?>$this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
