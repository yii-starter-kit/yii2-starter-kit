<?php
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use kartik\form\ActiveForm;
use kartik\widgets\Typeahead;
use yii\helpers\Url;
?>

<div class="system-article-search">
    <?php 
		$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
		'type' => ActiveForm::TYPE_INLINE,
    	]); 
	?>
	
<div class="input-group pull-right">
	<span class="input-group-btn">
    <?php 
	echo Typeahead::widget([
    'name' => 'q',
    'options' => ['placeholder' => 'search articles...'],
    'scrollable' => true,
    'pluginOptions' => ['highlight'=>true],
    'dataset' => [
        [
            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
            'display' => 'value',
            //'prefetch' => $baseUrl . '/samples/countries.json',
            'remote' => [
                'url' => Url::to(['article/search-list']) . '?q=%QUERY',
                'wildcard' => '%QUERY'
            ]
        ]
    ]
]);
    ?>
	</span>
	<?php echo  Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
</div>   
    <?php ActiveForm::end(); ?>
</div>
