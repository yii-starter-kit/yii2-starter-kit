<?php

namespace backend\modules\i18n;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\i18n\controllers';

    /**
     * @param \yii\i18n\MissingTranslationEvent $event
     */
    public static function missingTranslation($event)
    {
        // do something with missing translation
    }

    public function init()
    {
        parent::init();
    }
}
