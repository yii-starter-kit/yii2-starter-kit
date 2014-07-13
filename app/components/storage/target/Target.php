<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 1:16 PM
 */

namespace app\components\storage\target;

use app\components\storage\File;
use yii\base\Object;

abstract class Target extends Object{
    abstract public function save(File $file);
    abstract public function unlink(File $file);
}