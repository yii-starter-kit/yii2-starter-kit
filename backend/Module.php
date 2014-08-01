<?php

namespace backend\modules\manager;

use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\manager\controllers';
    public $layout = 'main';

    public function init()
    {
        if(!\Yii::$app->user->can('manager')){
            throw new ForbiddenHttpException;
        }
        \Yii::$app->view->title = \Yii::t('backend', 'Dashboard');
        parent::init();

        // custom initialization code goes here
    }
}
