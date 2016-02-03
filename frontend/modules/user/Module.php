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
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
