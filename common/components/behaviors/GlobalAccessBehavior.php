<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/1/14
 * Time: 10:34 AM
 */

namespace common\components\behaviors;

use yii\base\Behavior;
use yii\base\Controller;
use yii\filters\AccessControl;

class GlobalAccessBehavior extends Behavior{

    public $rules = [];

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION=>'beforeAction'
        ];
    }

    public function beforeAction(){
        \Yii::$app->controller->attachBehavior('access', [
            'class'=>AccessControl::className(),
            'rules'=>$this->rules
        ]);
    }

} 