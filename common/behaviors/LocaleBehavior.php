<?php

namespace common\behaviors;

use yii\base\Behavior;
use Yii;
use yii\web\Application;

/**
 * Class LocaleBehavior
 * @package common\behaviors
 */
class LocaleBehavior extends Behavior
{
    /**
     * @var string
     */
    public $cookieName = '_locale';

    /**
     * @var bool
     */
    public $enablePreferredLanguage = true;
    /**
     * @return array
     */
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'beforeRequest'
        ];
    }

    /**
     * Resolve application language by checking user cookies, preferred language and profile settings
     */
    public function beforeRequest()
    {
        $hasCookie = Yii::$app->getRequest()->getCookies()->has($this->cookieName);
        $forceUpdate = Yii::$app->session->hasFlash('forceUpdateLocale');
        if ($hasCookie && !$forceUpdate)
        {
            $locale = Yii::$app->getRequest()->getCookies()->getValue($this->cookieName);
        } else {
            $locale = $this->resolveLocale();
        }
        Yii::$app->language = $locale;
    }

    public function resolveLocale()
    {
        $locale = Yii::$app->language;

        if (!Yii::$app->user->isGuest && Yii::$app->user->identity->userProfile->locale) {
            $locale = Yii::$app->user->getIdentity()->userProfile->locale;
        } elseif ($this->enablePreferredLanguage) {
            $locale = Yii::$app->request->getPreferredLanguage($this->getAvailableLocales());
        }

        return $locale;
    }

    /**
     * @return array
     */
    protected function getAvailableLocales()
    {
        return array_keys(Yii::$app->params['availableLocales']);
    }
}
