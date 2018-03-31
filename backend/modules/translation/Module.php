<?php

namespace backend\modules\translation;

/**
 * translation module definition class
 */
class Module extends \yii\base\Module
{
    /** @inheritdoc */
    public $controllerNamespace = 'backend\modules\translation\controllers';

    /**
     * @param \yii\i18n\MissingTranslationEvent $event
     */
    public static function missingTranslation($event)
    {
        // do something with missing translation
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
