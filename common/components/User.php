<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 */

namespace common\components;


class User extends \yii\web\User{
    public function init(){
        parent::init();
        // todo
        $locale = !$this->isGuest && $this->getIdentity()->profile->locale
            ? $this->getIdentity()->profile->locale
            : \Yii::$app->sourceLanguage;
        if(!\Yii::$app->session->has('user.locale')){
            \Yii::$app->language = $locale;
        }
    }
}