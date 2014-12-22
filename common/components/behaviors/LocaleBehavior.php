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

class LocaleBehavior extends Behavior{
    public function events()
    {
        return [
            \yii\web\Application::EVENT_BEFORE_REQUEST=>'beforeRequest'
        ];
    }

    public function beforeRequest(){
        if(Yii::$app->session->has('user.locale') && !Yii::$app->session->hasFlash('forceUpdateLocale')){
            $userLocale = Yii::$app->session->get('user.locale');
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