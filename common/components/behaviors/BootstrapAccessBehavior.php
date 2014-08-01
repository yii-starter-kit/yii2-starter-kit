<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/1/14
 * Time: 10:34 AM
 */

namespace common\components\behaviors;

use yii\base\Behavior;
use yii\web\Application;

class BootstrapAccessBehavior extends Behavior{
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST=>'beforeRequest'
        ];
    }

    public function beforeRequest(){
        // todo: implement through AccessFilter
        if(\Yii::$app->user->isGuest){
            \Yii::$app->catchAll = ['/user/login'];
        }
    }

} 