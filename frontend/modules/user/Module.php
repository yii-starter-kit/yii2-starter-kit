<?php

namespace frontend\modules\user;

class Module extends \yii\base\Module
{
    /**
     * @var string
     */
    public $controllerNamespace = 'frontend\modules\user\controllers';

    /**
     * @var bool Is users should be activated by email
     */
    public $shouldBeActivated = false;
    /**
     * @var bool Enables login by pass from backend
     */
    public $enableLoginByPass = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
