<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/5/14
 * Time: 12:11 PM
 */

namespace common\components\behaviors;

use yii\base\Behavior;
use Yii;

/**
 * Class LocaleBehavior
 * @package common\components\behaviors
 */
class LocaleBehavior extends Behavior{

    /**
     * @var string
     */
    public $cookieName = '_locale';

    /**
     * @return array
     */
    public function events()
    {
        return [
            \yii\web\Application::EVENT_BEFORE_REQUEST=>'beforeRequest'
        ];
    }

    /**
     * Resolve application language by checking user cookies, preferred language and profile settings
     */
    public function beforeRequest(){
        if(Yii::$app->getRequest()->getCookies()->has($this->cookieName) && !Yii::$app->session->hasFlash('forceUpdateLocale')){
            $userLocale = Yii::$app->getRequest()->getCookies()->getValue($this->cookieName);
        } else {
            $userLocale = !Yii::$app->user->isGuest
                        && Yii::$app->user->getIdentity()->profile
                        && Yii::$app->user->getIdentity()->profile->locale
                ? Yii::$app->user->getIdentity()->profile->locale
                : Yii::$app->request->getPreferredLanguage(array_keys(Yii::$app->params['availableLocales']));
        }
        Yii::$app->language = $userLocale;
    }
}