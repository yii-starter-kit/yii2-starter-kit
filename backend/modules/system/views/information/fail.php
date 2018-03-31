<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
use yii\helpers\Html;

$this->title = Yii::t('backend', 'System Information');
?>
<?php echo Yii::t(
    'backend',
    'Sorry, application failed to collect information about your system. See {link}.',
    ['link' => Html::a('trntv/probe', 'https://github.com/trntv/probe#user-content-supported-os')]
);
