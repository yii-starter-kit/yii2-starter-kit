<?php

namespace common\components\behaviors;

use yii\base\Behavior;
use yii\web\Application;

/**
 * Class MaintenanceBehavior
 * @package common\components\behaviors
 */
class MaintenanceBehavior extends Behavior
{
    /**
     * @var boolean|\Closure boolean value or Closure that return
     * boolean indicating if app in maintenance mode or not
     */
    public $enabled;
    /**
     * @var array
     * @see \yii\web\Application::catchAll
     */
    public $catchAll;

    /**
     * @return array
     */
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'beforeRequest'
        ];
    }

    /**
     * @param $event
     */
    public function beforeRequest($event)
    {
        if ($this->enabled instanceof \Closure) {
            $enabled = call_user_func($this->enabled, $event);
        } else {
            $enabled = $this->enabled;
        }
        if ($enabled) {
            $event->sender->catchAll = $this->catchAll;
        }
    }
}