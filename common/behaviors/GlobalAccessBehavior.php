<?php

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Controller;
use yii\filters\AccessControl;

/**
 * Class GlobalAccessBehavior
 * @package common\behaviors
 */
class GlobalAccessBehavior extends Behavior
{

    /**
     * @var array
     * @see \yii\filters\AccessControl::rules
     */
    public $rules = [];

    /**
     * @var string
     */
    public $accessControlFilter = AccessControl::class;

    /**
     * @var callable a callback that will be called if the access should be denied
     * to the current user. If not set, [[denyAccess()]] will be called.
     *
     * The signature of the callback should be as follows:
     *
     * ~~~
     * function ($rule, $action)
     * ~~~
     *
     * where `$rule` is the rule that denies the user, and `$action` is the current [[Action|action]] object.
     * `$rule` can be `null` if access is denied because none of the rules matched.
     */
    public $denyCallback;

    /**
     * @return array
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction()
    {
        Yii::$app->controller->attachBehavior('access', [
            'class' => $this->accessControlFilter,
            'denyCallback' => $this->denyCallback,
            'rules' => $this->rules
        ]);
    }
}
