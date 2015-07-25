<?php

namespace backend\modules\i18n;

use Yii;
use backend\modules\i18n\models\I18nSourceMessage;
use yii\i18n\MissingTranslationEvent;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\i18n\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @param MissingTranslationEvent $event
     */
    public static function missingTranslation(MissingTranslationEvent $event)
    {
        $driver = Yii::$app->getDb()->getDriverName();
        $caseInsensitivePrefix = $driver === 'mysql' ? 'binary' : '';
        $sourceMessage = I18nSourceMessage::find()
        ->where('category = :category and message = ' . $caseInsensitivePrefix . ' :message', [
            ':category' => $event->category,
            ':message' => $event->message
        ])
        ->with('i18nMessages')
        ->one();
        if (!$sourceMessage) {
            $sourceMessage = new I18nSourceMessage;
            $sourceMessage->setAttributes([
                'category' => $event->category,
                'message' => $event->message
            ], false);
            $sourceMessage->save(false);
        }
        $sourceMessage->initMessages();
        $sourceMessage->saveMessages();
    }
}
