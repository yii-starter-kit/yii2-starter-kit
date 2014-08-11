<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/5/14
 * Time: 12:11 PM
 */

namespace common\components\behaviors;

use yii\base\Behavior;

class LocaleBehavior extends Behavior{
    public function events()
    {
        return [
            \yii\web\Application::EVENT_BEFORE_REQUEST=>'beforeRequest'
        ];
    }

    public function beforeRequest(){
        if(\Yii::$app->session->has('user.locale')){
            \Yii::$app->language = \Yii::$app->session->get('user.locale');
        }
        return;
    }
} 