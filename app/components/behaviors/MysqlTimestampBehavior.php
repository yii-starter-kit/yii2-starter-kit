<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 3:00 PM
 */

namespace app\components\behaviors;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * Class MysqlTimestampBehavior
 * @package app\components\behaviors
 */
class MysqlTimestampBehavior extends TimestampBehavior{

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        if ($this->value instanceof Expression) {
            return $this->value;
        } else {
            return $this->value !== null ? call_user_func($this->value, $event) : new Expression('NOW()');
        }
    }
} 